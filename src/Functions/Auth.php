<?php

namespace BeeDelivery\LaraiFood\Functions;

class Auth
{
    protected $base_uri;
    protected $client_id;
    protected $client_secret;
    protected $grant_type;
    protected $accessToken;
    protected $refreshToken;
    protected $authorizationCode;
    protected $authorizationCodeVerifier;
    protected $verificationUrl;
    protected $verificationUrlComplete;

    public function __construct()
    {
        $this->base_uri = config('laraifood.base_uri');
        $this->client_id = config('laraifood.client_id');
        $this->client_secret = config('laraifood.client_secret');
        $this->grant_type = config('laraifood.grant_type');
    }

    public function getUserCode()
    {

        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri,
        ]);

        try {
            $response = $client->request('POST', "authentication/v1.0/oauth/userCode", [
                'allow_redirects' => false,
                'header' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'clientId' => $this->client_id
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

    public function getToken($data = array())
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->base_uri,
        ]);

        $formParams = [
            'grantType' => isset($data['refreshToken']) ? 'refresh_token' : $this->grant_type,
            'clientId' => $this->client_id,
            'clientSecret' => $this->client_secret,
            'authorizationCode' => isset($data['authorizationCode']) ? $data['authorizationCode'] : null,
            'authorizationCodeVerifier' => isset($data['authorizationCodeVerifier']) ? $data['authorizationCodeVerifier'] : null,
            'refreshToken' => isset($data['refreshToken']) ? $data['refreshToken'] : null
        ];

        try {
            $response = $client->request('POST', "authentication/v1.0/oauth/token", [
                'allow_redirects' => false,
                'header' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $formParams
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
