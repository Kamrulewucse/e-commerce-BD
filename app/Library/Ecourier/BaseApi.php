<?php

namespace App\Library\Ecourier;

use  GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use App\Exceptions\EcourierException;
use App\Exceptions\EcourierValidationException;

class BaseApi
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Client
     */
    private $request;

    /**
     * @var array
     */
    private $headers;

    public function __construct()
    {
        $this->setBaseUrl();
        $this->setHeaders();
        $this->request = new Client([
            'base_uri' => $this->baseUrl,
            'headers'  => $this->headers
        ]);
    }

    /**
     * Set Base Url on sandbox mode
     */
    private function setBaseUrl()
    {
        if (config("ecourier.sandbox") == true) {
            $this->baseUrl = "https://staging.ecourier.com.bd";
        } else {
            $this->baseUrl = "https://backoffice.ecourier.com.bd";
        }
    }

    /**
     * Set Default Headers
     */
    private function setHeaders()
    {
        $this->headers = [
            "Accept"       => "application/json",
            "Content-Type" => "application/json",
        ];
    }


    /**
     * Authorization set to header
     *
     * @return $this
     */
    public function authorization()
    {
        $this->headers = [
            "Accept"       => "application/json",
            "Content-Type" => "application/json",
            'API-KEY'      => config("ecourier.app_key"),
            'API-SECRET'   => config("ecourier.app_secret"),
            'USER-ID'      => config("ecourier.user_id")
        ];

        return $this;
    }

    /**
     * Sending Request
     *
     * @param string $method
     * @param string $uri
     * @param array $body
     *
     * @return mixed
     * @throws EcourierException
     * @throws GuzzleException
     */
    public function send($method, $uri, $body = [])
    {
        try {
            $response = $this->request->request($method, $uri, [
                "headers" => $this->headers,
                "body"    => json_encode($body)
            ]);
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            $message  = implode(",", $response->errors);
            throw new EcourierException($message, $e->getCode(), $response->errors);
        }
    }

    /**
     * Ecourier validation
     *
     * @param array $data
     * @param array $requiredFileds
     *
     * @throws EcourierValidationException
     */
    public function validation($data, $requiredFileds)
    {
        if (!is_array($data) || !is_array($requiredFileds)) {
            throw new \TypeError("Argument must be of the type array", 500);
        }

        if (!count($data) || !count($requiredFileds)) {
            throw new EcourierValidationException("Invalid data!", 422);
        }

        $requiredColumns = array_diff($requiredFileds, array_keys($data));
        if (count($requiredColumns)) {
            throw new EcourierValidationException($requiredColumns, 422);
        }

        foreach ($requiredFileds as $filed) {
            if (isset($data[$filed]) && empty($data[$filed])) {
                throw new EcourierValidationException("$filed is required", 422);
            }
        }

    }

}
