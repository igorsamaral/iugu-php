<?php

namespace Iugu;

use Iugu\Iugu;
use Iugu\RequestHandler;
use Iugu\ResponseHandler;
use Iugu\Endpoints\Customers;
use Iugu\Endpoints\Charges;
use Iugu\Endpoints\Invoices;
use Iugu\Endpoints\PaymentToken;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ClientException;
use Iugu\Exceptions\InvalidJsonException;

class Client
{
    /**
     * @var string
     */
    const BASE_URI = 'https://api.iugu.com/v1/';

    /**
     * @var string header used to identify application's requests
     */
    const IUGU_USER_AGENT_HEADER = 'X-Iugu-User-Agent';

    /**
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var \Iugu\Endpoints\Customers
     */
    private $customers;

    /**
     * @var \Iugu\Endpoints\Invoices
     */
    private $invoices;

    /**
     * @var \Iugu\Endpoints\PaymentToken
     */
    private $paymentToken;

    /**
     * @var \Iugu\Endpoints\Charges
     */
    private $charges;

    /**
     * @param string $apiKey
     * @param array|null $extras
     */
    public function __construct($apiKey, array $extras = null)
    {
        $this->apiKey = $apiKey;

        $options = ['base_uri' => self::BASE_URI];

        if (!is_null($extras)) {
            $options = array_merge($options, $extras);
        }

        $userAgent = isset($options['headers']['User-Agent']) ?
            $options['headers']['User-Agent'] :
            '';

        $options['headers']['User-Agent'] = $this->addUserAgentHeaders($userAgent);
        $options['headers']['X-Iugu-User-Agent'] = $this->addUserAgentHeaders($userAgent);

        $this->http = new HttpClient($options);

        $this->customers = new Customers($this);
        $this->invoices = new Invoices($this);
        $this->paymentToken = new PaymentToken($this);
        $this->charges = new Charges($this);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @throws \Iugu\Exceptions\IuguException
     * @return \ArrayObject
     *
     * @psalm-suppress InvalidNullableReturnType
     */
    public function request($method, $uri, $options = [])
    {
        try {
            $response = $this->http->request(
                $method,
                $uri,
                RequestHandler::bindApiKeyToQueryString(
                    $options,
                    $this->apiKey
                )
            );

            return ResponseHandler::success((string)$response->getBody());
        } catch (InvalidJsonException $exception) {
            throw $exception;
        } catch (ClientException $exception) {
            ResponseHandler::failure($exception);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Build an user-agent string to be informed on requests
     *
     * @param string $customUserAgent
     *
     * @return string
     */
    private function buildUserAgent($customUserAgent = '')
    {
        return trim(sprintf(
            '%s iugu-php/%s php/%s',
            $customUserAgent,
            Iugu::VERSION,
            phpversion()
        ));
    }

    /**
     * Append new keys (the default and iugu) related to user-agent
     *
     * @param string $customUserAgent
     * @return string
     */
    private function addUserAgentHeaders($customUserAgent = '')
    {
        return $this->buildUserAgent($customUserAgent);
    }

    /**
     * @return \Iugu\Endpoints\Customers
     */
    public function customers()
    {
        return $this->customers;
    }

    /**
     * @return \Iugu\Endpoints\Invoices
     */
    public function invoices()
    {
        return $this->invoices;
    }

    /**
     * @return \Iugu\Endpoints\PaymentToken
     */
    public function paymentToken()
    {
        return $this->paymentToken;
    }

    /**
     * @return \Iugu\Endpoints\Charges
     */
    public function charges()
    {
        return $this->charges;
    }
}
