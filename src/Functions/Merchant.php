<?php

namespace BeeDelivery\LaraiFood\Functions;

use BeeDelivery\LaraiFood\Connection;

class Merchant
{
    protected $base_uri;
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
        $this->base_uri = config('laraifood.base_uri');
    }

    public function getAllMerchants()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri,
        ]);

        try {
            $response = $client->request('GET', "merchant/v1.0/merchants", [
                'allow_redirects' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];

        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }

    }

    public function getMerchant($merchantId)
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri,
        ]);

        try{
            $response = $client->request('GET', "merchant/v1.0/merchants/$merchantId", [
                'allow_redirects' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]);

            return [
                'code' => $response->getStatusCode(),
                'response' => json_decode($response->getBody(), true)
            ];

        } catch (\Exception $e) {
            return [
                'code' => $e->getCode(),
                'response' => $e->getMessage()
            ];
        }
    }
}
