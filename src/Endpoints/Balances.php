<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Balances extends Endpoint
{
    /**
     * @return \ArrayObject
     */
    public function get()
    {
        return $this->client->request(
            self::GET,
            Routes::balances()->base()
        );
    }
}
