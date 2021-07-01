<?php

namespace App\Services\Iugu\Endpoints;

use App\Services\Iugu\Client;
use App\Services\Iugu\Routes;
use App\Services\Iugu\Endpoints\Endpoint;

class Postbacks extends Endpoint
{
    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function redeliver(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::postbacks()->redeliver(
                $payload['model'],
                $payload['model_id'],
                $payload['postback_id']
            )
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
            Routes::postbacks()->details(
                $payload['model'],
                $payload['model_id'],
                $payload['postback_id']
            )
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function getList(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::postbacks()->base(
                $payload['model'],
                $payload['model_id']
            )
        );
    }

    /**
     * @param string $payload
     * @param string $signature
     *
     * @return boolean
     */
    public function validate($payload, $signature)
    {
        $parts = explode('=', $signature, 2);

        if (count($parts) != 2) {
            return false;
        }

        $apiKey = $this->client->getApiKey();

        return hash_hmac($parts[0], $payload, $apiKey) === $parts[1];
    }
}
