<?php

return [
    'consumer_key' => env('WS_AUTH_CONSOUMER_KEY', ""),
    'consumer_secret' => env('WS_AUTH_CONSOUMER_SECRET', ""),
    'client_id' => env('WS_AUTH_CLIENT_ID', ""),
    'apimws_url' => env('WS_AUTH_APIMWS_URL', "https://apimws.bkn.go.id"),
    'apimws_port' => env('WS_AUTH_APIMWS_PORT', 8243),
    'sso_siasn_url' => env('WS_AUTH_SSO_SIASN_URL', "https://sso-siasn.bkn.go.id"),
    'api_siasn_url' => env('WS_AUTH_API_SIASN_URL', "https://api-siasn.bkn.go.id"),
];
