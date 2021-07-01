<?php

namespace App\Services\Iugu;

class RequestHandler
{
    /**
     * @param array $options
     * @param string $apiKey
     *
     * @return array
     */
    public static function bindApiKeyToQueryString(array $options, $apiKey)
    {
        $options['query']['api_token'] = $apiKey;

        return $options;
    }
}
