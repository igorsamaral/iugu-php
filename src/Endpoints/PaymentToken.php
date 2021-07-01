<?php

namespace Iugu\Endpoints;

use Iugu\Routes;
use Iugu\Endpoints\Endpoint;

class PaymentToken extends Endpoint
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
            Routes::paymentToken()->base(),
            ['json' => $payload]
        );
    }

    /**
     * @param array|null $payload
     *
     * @return \ArrayObject
     */
    public function charge(array $payload = null)
    {
        return $this->client->request(
            self::POST,
            Routes::paymentToken()->base(),
            ['query' => $payload]
        );
    }
}
