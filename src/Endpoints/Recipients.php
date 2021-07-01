<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Recipients extends Endpoint
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
            Routes::recipients()->base(),
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
            Routes::recipients()->base(),
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
            Routes::recipients()->details($payload['id'])
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
            Routes::recipients()->details($payload['id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function getBalance(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::recipients()->balance($payload['recipient_id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function listBalanceOperation(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::recipients()->balanceOperations($payload['recipient_id']),
            ['query' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function getBalanceOperation(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::recipients()->balanceOperation(
                $payload['recipient_id'],
                $payload['balance_operation_id']
            )
        );
    }
}
