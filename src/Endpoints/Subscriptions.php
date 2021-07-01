<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Subscriptions extends Endpoint
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
            Routes::subscriptions()->base(),
            ['json' => $payload]
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
            Routes::subscriptions()->details($payload['id'])
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
            Routes::subscriptions()->base(),
            ['query' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function update(array $payload)
    {
        return $this->client->request(
            self::PUT,
            Routes::subscriptions()->details($payload['id']),
            ['json' => $payload]
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
            Routes::subscriptions()->cancel($payload['id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function transactions(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::subscriptions()->transactions($payload['subscription_id']),
            ['query' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function settleCharges(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::subscriptions()->settleCharges($payload['id']),
            ['json' => $payload]
        );
    }
}
