<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\EndpointInterface;
use App\Services\Iugu\Endpoints\Endpoint;

class Transactions extends Endpoint
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
            Routes::transactions()->base(),
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
            Routes::transactions()->base(),
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
            Routes::transactions()->details($payload['id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function capture(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::transactions()->capture($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function refund(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::transactions()->refund($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function listPayables(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::transactions()->payables($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function getPayable(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::transactions()->payablesDetails(
                $payload['transaction_id'],
                $payload['payable_id']
            ),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function listOperations(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::transactions()->operations($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function collectPayment(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::transactions()->collectPayment($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function events(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::transactions()->events($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function simulateStatus(array $payload)
    {
        return $this->client->request(
            self::PUT,
            Routes::transactions()->details($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function calculateInstallments(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::transactions()->calculateInstallments(),
            ['json' => $payload]
        );
    }
}
