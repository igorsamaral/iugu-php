<?php

namespace Iugu\Endpoints;

use Iugu\Routes;
use Iugu\Endpoints\Endpoint;

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
