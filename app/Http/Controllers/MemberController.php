<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($apiKey, $listId)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members?count=1000';

        $response = mailChimpRequest($auth, $url);

        return view('members.index', ['key' => $apiKey, 'members'=>$response['members'], 'listId'=>$listId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($apiKey, $listId)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId;

        $response = mailChimpRequest($auth, $url);
        return view('members.create', ['key' => $apiKey, 'list'=>$response]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $apiKey, $listId)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members';

        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"

        }';

        $response = mailChimpRequest($auth, $url, 'POST', $body);

        return redirect('/'.$apiKey. '/lists/' . $listId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($apiKey, $listId, $memberId)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members/'. $memberId;

        $response = mailChimpRequest($auth, $url);

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($apiKey, $listId, $memberId)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members/' . $memberId;

        $response = mailChimpRequest($auth, $url);
        return view('members.edit', ['key' => $apiKey, 'listId'=>$listId, 'member'=>$response]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $apiKey, $listId, $memberEmail)
    {
        $auth = makeAuth($apiKey);
        $hash = md5(strtolower($memberEmail));
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $hash;

        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"

        }';

        $response = mailChimpRequest($auth, $url, 'PATCH', $body);

        return redirect('/'.$apiKey. '/lists/' . $listId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
