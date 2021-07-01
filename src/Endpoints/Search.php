<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Search extends Endpoint
{
    /**
     * @param array|null $payload
     *
     * @return \ArrayObject
     */
    public function get(array $payload = null)
    {
        return $this->client->request(
            self::GET,
            Routes::search()->base(),
            ['query' => $payload]
        );
    }
}
