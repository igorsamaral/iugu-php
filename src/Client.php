<?php

namespace App\Services\Iugu;

use App\Services\Iugu\Iugu;
use App\Services\Iugu\RequestHandler;
use App\Services\Iugu\ResponseHandler;
use App\Services\Iugu\Endpoints\BankAccounts;
use App\Services\Iugu\Endpoints\BulkAnticipations;
use App\Services\Iugu\Endpoints\Transactions;
use App\Services\Iugu\Endpoints\Customers;
use App\Services\Iugu\Endpoints\Cards;
use App\Services\Iugu\Endpoints\Recipients;
use App\Services\Iugu\Endpoints\PaymentLinks;
use App\Services\Iugu\Endpoints\Plans;
use App\Services\Iugu\Endpoints\Transfers;
use App\Services\Iugu\Endpoints\Subscriptions;
use App\Services\Iugu\Endpoints\Refunds;
use App\Services\Iugu\Endpoints\Postbacks;
use App\Services\Iugu\Endpoints\Balances;
use App\Services\Iugu\Endpoints\Payables;
use App\Services\Iugu\Endpoints\BalanceOperations;
use App\Services\Iugu\Endpoints\Chargebacks;
use App\Services\Iugu\Endpoints\Search;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ClientException;
use App\Services\Iugu\Exceptions\InvalidJsonException;

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
     * @var \Iugu\Endpoints\Transactions
     */
    private $transactions;

    /**
     * @var \Iugu\Endpoints\Customers
     */
    private $customers;

    /**
     * @var \Iugu\Endpoints\Cards
     */
    private $cards;

    /**
     * @var \Iugu\Endpoints\Recipients
     */
    private $recipients;

    /**
     * @var \Iugu\Endpoints\BankAccounts
     */
    private $bankAccounts;

    /**
     * @var \Iugu\Endpoints\Plans
     */
    private $plans;

    /**
     * @var \Iugu\Endpoints\BulkAnticipations
     */
    private $bulkAnticipations;

    /**
     * @var \Iugu\Endpoints\PaymentLinks
     */
    private $paymentLinks;

    /**
     * @var \Iugu\Endpoints\Transfers
     */
    private $transfers;

    /**
     * @var \Iugu\Endpoints\Subscriptions
     */
    private $subscriptions;

    /**
     * @var \Iugu\Endpoints\Refunds
     */
    private $refunds;

    /**
     * @var \Iugu\Endpoints\Postbacks
     */
    private $postbacks;

    /**
     * @var \Iugu\Endpoints\Balances
     */
    private $balances;

    /**
     * @var \Iugu\Endpoints\Payables
     */
    private $payables;

    /**
     * @var \Iugu\Endpoints\BalanceOperations
     */
    private $balanceOperations;

    /**
     * @var \Iugu\Endpoints\Chargebacks
     */
    private $chargebacks;

    /**
     * @var \Iugu\Endpoints\Search
     */
    private $search;

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

        $this->transactions = new Transactions($this);
        $this->customers = new Customers($this);
        $this->cards = new Cards($this);
        $this->recipients = new Recipients($this);
        $this->bankAccounts = new BankAccounts($this);
        $this->plans = new Plans($this);
        $this->bulkAnticipations = new BulkAnticipations($this);
        $this->paymentLinks = new PaymentLinks($this);
        $this->transfers = new Transfers($this);
        $this->subscriptions = new Subscriptions($this);
        $this->refunds = new Refunds($this);
        $this->postbacks = new Postbacks($this);
        $this->balances = new Balances($this);
        $this->payables = new Payables($this);
        $this->balanceOperations = new BalanceOperations($this);
        $this->chargebacks = new Chargebacks($this);
        $this->search = new Search($this);
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
     * @return \Iugu\Endpoints\Transactions
     */
    public function transactions()
    {
        return $this->transactions;
    }

    /**
     * @return \Iugu\Endpoints\Customers
     */
    public function customers()
    {
        return $this->customers;
    }

    /**
     * @return \Iugu\Endpoints\Cards
     */
    public function cards()
    {
        return $this->cards;
    }

    /**
     * @return \Iugu\Endpoints\Recipients
     */
    public function recipients()
    {
        return $this->recipients;
    }

    /**
     * @return \Iugu\Endpoints\BankAccounts
     */
    public function bankAccounts()
    {
        return $this->bankAccounts;
    }

    /**
     * @return \Iugu\Endpoints\Plans
     */
    public function plans()
    {
        return $this->plans;
    }

    /**
     * @return \Iugu\Endpoints\BulkAnticipations
     */
    public function bulkAnticipations()
    {
        return $this->bulkAnticipations;
    }

    /**
     * @return \Iugu\Endpoints\PaymentLinks
     */
    public function paymentLinks()
    {
        return $this->paymentLinks;
    }

    /**
     * @return \Iugu\Endpoints\Transfers
     */
    public function transfers()
    {
        return $this->transfers;
    }

    /**
     * @return \Iugu\Endpoints\Subscriptions
     */
    public function subscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @return \Iugu\Endpoints\Refunds
     */
    public function refunds()
    {
        return $this->refunds;
    }

    /**
     * @return \Iugu\Endpoints\Postbacks
     */
    public function postbacks()
    {
        return $this->postbacks;
    }

    /**
     * @return \Iugu\Endpoints\Balances
     */
    public function balances()
    {
        return $this->balances;
    }

    /**
     * @return \Iugu\Endpoints\Payables
     */
    public function payables()
    {
        return $this->payables;
    }

    /**
     * @return \Iugu\Endpoints\BalanceOperations
     */
    public function balanceOperations()
    {
        return $this->balanceOperations;
    }

    /**
     * @return \Iugu\Endpoints\Chargebacks
     */
    public function chargebacks()
    {
        return $this->chargebacks;
    }

    /**
     * @return \Iugu\Endpoints\Search
     */
    public function search()
    {
        return $this->search;
    }
}
