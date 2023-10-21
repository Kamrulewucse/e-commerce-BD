<?php

namespace App\Library\Ecourier;

use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\EcourierException;
use App\Exceptions\EcourierValidationException;

class OrderApi extends BaseApi
{
    /**
     * Package list
     *
     * @return mixed
     * @throws EcourierException
     * @throws GuzzleException
     */
    public function packageList()
    {
        $response = $this->authorization()->send("POST", "api/packages");
        return $response;
    }

    /**
     * Create Order
     *
     * @param array $array
     *
     * @return JsonResponse
     * @throws EcourierException
     * @throws GuzzleException|EcourierValidationException
     */
    public function create($array)
    {
        $this->validation($array, [
            "recipient_name" ,
            "recipient_mobile",
            "recipient_city",
            "recipient_thana",
            "recipient_area",
            "package_code",
            "recipient_address",
            "payment_method" ,
            "recipient_zip",
            "parcel_type",
            "parcel_detail",
            "number_of_item",
            "ep_id",
        ]);

        $response = $this->authorization()->send("POST", "api/order-place", $array);
        return response()->json([
            "success"       => $response->success,
            "response_code" => $response->response_code,
            "message"       => $response->message,
            "ID"            => $response->ID,
        ]);
    }

    /**
     * @param $trackingId
     *
     * @return mixed
     * @throws EcourierException
     * @throws GuzzleException
     */
    public function tracking($trackingId)
    {
        $response = $this->authorization()->send("POST", "api/track", ["ecr" => $trackingId]);
        return $response;
    }


    /**
     * Cancel Order
     *
     * @param array $array
     *
     * @return mixed
     * @throws EcourierException
     * @throws EcourierValidationException
     * @throws GuzzleException
     */
    public function cancelOrder($array)
    {
        $this->validation($array, ["tracking", "comment"]);
        $response = $this->authorization()->send("POST", "api/cancel-order", $array);
        return $response;
    }
}
