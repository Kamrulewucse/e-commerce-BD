<?php

namespace App\Library\Pathao;

use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\PathaoCourierValidationException;
use App\Exceptions\PathaoException;

class StoreApi extends BaseApi
{
    /**
     *  Get Store List
     *
     * @param int $page
     *
     * @return mixed
     * @throws GuzzleException
     * @throws PathaoException
     */
    public function list($page = 1)
    {
        $response = $this->authorization()->send("GET", "aladdin/api/v1/stores?page={$page}");
        return $response->data;
    }

    /**
     * Store Create
     *
     * @param array $storeInfo
     *
     * @return mixed
     * @throws GuzzleException
     * @throws PathaoException|PathaoCourierValidationException
     */
    public function create($storeInfo)
    {
        $this->validation($storeInfo, [
            "name", "contact_name", "contact_number", "address", "city_id", "zone_id", "area_id"
        ]);

        $response = $this->authorization()->send("POST", "aladdin/api/v1/stores", $storeInfo);
        return $response->data;
    }
}
