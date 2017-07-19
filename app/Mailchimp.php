<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Mailchimp
{
    protected $url;
    protected $key;
    protected $auth;

    public function __construct()
    {
        $this->key = config('app.mailchimp_api_key');
        $this->auth = $this->makeAuth($this->key);
    }

    public function getLists($limit = 100)
    {
        $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists?count=' . $limit;

        return $this->request($url)['lists'];
    }

    public function getMembers($id , $limit = 100)
    {
        $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $id . '/members?count=' . $limit;

        return $this->request($url)['members'];
    }

    public function storeList($request)
    {
      $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists';

      $body = '{
          "name" : "'. $request->name .'",
          "contact" : {
              "company" : "'. $request->contact_company .'",
              "address1" : "'. $request->contact_address .'",
              "city" : "'. $request->contact_city .'",
              "state" : "'. $request->contact_state .'",
              "zip" : "'. $request->contact_zip .'",
              "country" : "'. $request->contact_country .'"
          },
          "permission_reminder" : "'. $request->permission_reminder .'",
          "campaign_defaults" : {
              "from_name" : "'. $request->campaign_defaults_from_name .'",
              "from_email" : "'. $request->campaign_defaults_from_email .'",
              "subject" : "'. $request->campaign_defaults_subject .'",
              "language" : "'. $request->campaign_defaults_language .'"
          },
          "email_type_option" : '. $request->email_type_option .'
      }';

      return $this->request($url, 'POST', $body);
    }

    private function request($url, $type = 'GET', $body = '')
    {
        $client = new Client();
        $response = $client->request($type, $url, [
          'auth' => ['user', $this->auth['apiKey']],
          'body' => $body
        ]);

        return json_decode($response->getBody(), true);
    }

    private function makeAuth($apiKey)
    {
      $auth['apiKey'] = $apiKey;
      $auth['dc'] = substr($auth['apiKey'], -3);

      return $auth;
    }

}
