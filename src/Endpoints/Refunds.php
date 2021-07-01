<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Refunds extends Endpoint
{
    /**
     * @param array|null $payload
     *
     * @return \ArrayObject
     */
    public function getList(array $payload = null)
    {
        return $this->client->request(
            self::GET,
            Routes::refunds()->base(),
            ['query' => $payload]
        );
    }
}
