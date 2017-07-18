<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Mailchimp
{
    protected $url;
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getLists($limit = 100)
    {
        $auth = $this->makeAuth($this->key);
        $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists?count=' . $limit;


        // return $auth['apiKey'];
        $client = new Client();
        $response = $client->request('GET', $url, [
            'auth' => ['user', $auth['apiKey']],
        ]);

        return json_decode($response->getBody(), true);

    }

    public static function request($auth ,$url ,$type = 'GET', $body = '')
    {
        $client = new Client();
        $response = $client->request($type, $url, [
            'auth' => ['user', $auth['apiKey']],
            'body' => $body
        ]);

        return json_decode($response->getBody(), true);
    }

    // public static function makeAuth($apiKey)
    // {
    //   $auth['apiKey'] = $apiKey;
    //   $auth['dc'] = substr($auth['apiKey'], -3);
    //
    //   return $auth;
    // }

    protected function makeAuth($apiKey)
    {
      $auth['apiKey'] = $apiKey;
      $auth['dc'] = substr($auth['apiKey'], -3);

      return $auth;
    }
}
