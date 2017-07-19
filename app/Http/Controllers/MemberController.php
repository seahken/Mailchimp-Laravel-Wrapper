<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailchimp;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($listId)
    {
        $mailchimp = new Mailchimp();
        $members = $mailchimp->getMembers($listId);
        return view('members.index', ['members'=>$members, 'listId'=>$listId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($apiKey, $listId)
    {
        $auth = Mailchimp::makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId;

        $response = Mailchimp::request($auth, $url);
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
        $auth = Mailchimp::makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members';

        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"

        }';

        $response = Mailchimp::request($auth, $url, 'POST', $body);

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
        $auth = Mailchimp::makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members/'. $memberId;

        $response = Mailchimp::request($auth, $url);

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
        $auth = Mailchimp::makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $listId . '/members/' . $memberId;

        $response = Mailchimp::request($auth, $url);
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
        $auth = Mailchimp::makeAuth($apiKey);
        $hash = md5(strtolower($memberEmail));
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $hash;

        $body = '{
            "email_address" : "'. $request->email_address .'",
            "status" : "'. $request->status .'"

        }';

        $response = Mailchimp::request($auth, $url, 'PATCH', $body);

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
