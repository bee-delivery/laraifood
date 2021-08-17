<?php

namespace BeeDelivery\LaraiFood\Functions;

use BeeDelivery\LaraiFood\Connection;

class Order
{
    protected $base_uri;
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
        $this->base_uri = config('laraifood.base_uri');
    }

    public function eventsPolling()
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri,
        ]);

        try {
            $response = $client->request('POST', "order/v1.0/events:polling", [
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
