<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Mailchimp
{
    private $key;
    
    public function __construct($key = null)
    {
        $this->key = $key ?? config('app.mailchimp_api_key');
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

    public function getMember($listId, $memberId)
    {
        $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members/' . $memberId;

        return $this->request($url);
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

    public function storeMember($request, $listId)
    {
        $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members';
        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"
        }';

        return $this->request($url, 'POST', $body);
    }

    public function updateMember($request, $listId, $memberEmail)
    {
        $hash = md5(strtolower($memberEmail));
        $url = 'https://'. $this->auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $hash;

        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"
        }';

        return $this->request($url, 'PATCH', $body);
    }

    protected function request($url, $type = 'GET', $body = '')
    {
        $client = new Client();
        try {
          $response = $client->request($type, $url, [
            'auth' => ['user', $this->auth['apiKey']],
            'body' => $body
          ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
          dd($e->getResponse()->getBody()->getContents());
        }

        return json_decode($response->getBody(), true);
    }

    protected function makeAuth($apiKey)
    {
      $auth['apiKey'] = $apiKey;
      $auth['dc'] = substr($auth['apiKey'], -3);

      return $auth;
    }

}
