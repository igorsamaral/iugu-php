<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Charges extends Endpoint
{
    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function create(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::charges()->base(),
            ['json' => $payload]
        );
    }
}
