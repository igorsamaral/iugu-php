<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class PaymentLinks extends Endpoint
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
            Routes::paymentLinks()->base(),
            ['json' => $payload]
        );
    }

    /**
     * @param array|null $payload
     *
     * @return \ArrayObject
     */
    public function getList(array $payload = null)
    {
        return $this->client->request(
            self::GET,
            Routes::paymentLinks()->base(),
            ['query' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function get(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::paymentLinks()->details($payload['id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function cancel(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::paymentLinks()->cancel($payload['id'])
        );
    }
}
