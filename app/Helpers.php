<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

function mailChimpRequest($auth ,$url ,$type = 'GET', $body = '')
{
    $client = new Client();
    $response = $client->request($type, $url, [
        'auth' => ['user', $auth['apiKey']],
        'body' => $body
    ]);

    return json_decode($response->getBody(), true);

}

function makeAuth($apiKey)
{
    $auth['apiKey'] = $apiKey;
    $auth['dc'] = substr($auth['apiKey'], -3);

    return $auth;
}
