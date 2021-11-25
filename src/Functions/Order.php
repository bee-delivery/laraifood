<?php

namespace BeeDelivery\LaraiFood\Functions;

use BeeDelivery\LaraiFood\Connection;
use GuzzleHttp\Client;

class Order
{
    protected $accessToken;
    protected $client;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;

        $this->client = new Client([
            'base_uri' => config('laraifood.base_uri'),
        ]);
    }

    /**
     * State changes and other kinds of notifications related to orders on the platform.
     *
     * @param string $groups
     * @param string $types
     * @return array
     */
    public function eventsPolling($groups = null, $types = null)
    {
        try {
            $response = $this->client->request('GET', "order/v1.0/events:polling", [
                'allow_redirects' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
                'query' => [
                    'groups' => $groups,
                    'types' => $types,
                ]
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

    /**
     * Full information on the order (items, payment, delivery information, etc.).
     *
     * @param uuid $orderId
     * @return array
     */
    public function details($orderId)
    {
        try {
            $response = $this->client->request('GET', "order/v1.0/orders/$orderId", [
                'allow_redirects' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ]
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

    /**
     * Acknowledge a set of events, dismissing them from future polling calls.
     *
     * @param array $events
     * @return array
     */
    public function acknowledge($events)
    {
        try {
            $response = $this->client->request('POST', "order/v1.0/events/acknowledgment", [
                'allow_redirects' => false,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'content-type' => 'application/json'
                ],
                'body' => json_encode($events),
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
