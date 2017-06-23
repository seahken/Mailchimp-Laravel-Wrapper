<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Mailchimp
{
    protected $url;

    public static function request($auth ,$url ,$type = 'GET', $body = '')
    {
        $client = new Client();
        $response = $client->request($type, $url, [
            'auth' => ['user', $auth['apiKey']],
            'body' => $body
        ]);

        return json_decode($response->getBody(), true);
    }

    public static function makeAuth($apiKey)
    {
      $auth['apiKey'] = $apiKey;
      $auth['dc'] = substr($auth['apiKey'], -3);

      return $auth;
    }
}
