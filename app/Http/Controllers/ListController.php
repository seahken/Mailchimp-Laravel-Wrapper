<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailchimp;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailchimp = new Mailchimp();
        $lists = $mailchimp->lists()->get();

        return view('lists.index', ['lists'=>$lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mailchimp = new Mailchimp();
        $newList = $mailchimp->storeList($request);

        return redirect('/lists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $auth = Mailchimp::makeAuth($apiKey);
        // $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $id;
        //
        // $response = Mailchimp::request($auth, $url);
        //
        // return view('lists.show', ['list'=>$response, 'key'=> $apiKey]);

        $mailchimp = new Mailchimp();
        $members = $mailchimp->members($id)->get();

        return $members;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
