<?php

namespace BeeDelivery\LaraiFood;

use GuzzleHttp\Client;

class Connection {

    protected $http;
    protected $access_token;
    protected $api_key;
    protected $client_id;

    public function __construct($customHeaders = array()) {

        $this->baseUrl = config('laraifood.baseUrl');
        $this->apiKey = config('laraifood.apiKey');
        $this->clientId = config('laraifood.clientId');

        $headers = array_merge([
            'Content-Type'  => 'application/json'
        ], $customHeaders);

        $this->http = new Client([
            'headers' => $headers
        ]);

        return $this->http;
    }

    public function get($url)
    {
        try {
            $response = $this->http->get($this->baseUrl . $url);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function post($url, $params)
    {
        try {
            $response = $this->http->post($this->baseUrl . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
}
