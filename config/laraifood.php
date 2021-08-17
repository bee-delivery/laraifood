<?php

return [
    'client_id' => env('IFOOD_CLIENT_ID', ''),
    'client_secret' => env('IFOOD_CLIENT_SECRET', ''),
    'base_uri' => env('IFOOD_BASE_URI', 'https://merchant-api.ifood.com.br'),
    'grant_type' => env('IFOOD_GRANT_TYPE', 'authorization_code')
];
