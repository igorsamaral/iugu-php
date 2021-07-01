<?php

namespace Iugu\Endpoints;

use Iugu\Client;

abstract class Endpoint
{
    /**
     * @var string
     */
    const POST = 'POST';
    /**
     * @var string
     */
    const GET = 'GET';
    /**
     * @var string
     */
    const PUT = 'PUT';
    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var \Iugu\Client
     */
    protected $client;

    /**
     * @param \Iugu\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
