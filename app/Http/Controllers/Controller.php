<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function data($apiKey)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists?count=1000';
        $response = mailChimpRequest($auth, $url);

        // dd($response['lists']);
        return view('data', [
            'key'=> $apiKey,
            'lists' => $response['lists']
            ]);

    }

    public function auth(Request $request)
    {
        $auth = makeAuth($request->apiKey);
        $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0';
        $response = mailChimpRequest($auth, $url);

        return redirect('/'.$auth['apiKey']);

    }
}
