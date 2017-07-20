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
    public function create($listId)
    {
        return view('members.create', ['listId'=>$listId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $listId)
    {
        $mailchimp = new Mailchimp();
        $newMember = $mailchimp->storeMember($request, $listId);

        return redirect('/lists/' . $listId . '/members');
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
    public function edit($listId, $memberId)
    {
        $mailchimp = new Mailchimp();
        $member = $mailchimp->getMember($listId, $memberId);

        return view('members.edit', ['listId'=>$listId, 'member'=>$member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $listId, $memberEmail)
    {
        $mailchimp = new Mailchimp();
        $updatedMember = $mailchimp->updateMember($request, $listId, $memberEmail);

        return redirect('/lists/' . $listId . '/members');
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
