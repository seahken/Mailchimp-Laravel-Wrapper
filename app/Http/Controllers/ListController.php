<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($apiKey)
    {
        return view('lists.create', ['key' => $apiKey]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $apiKey)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists';

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

        $response = mailChimpRequest($auth, $url, 'POST', $body);

        return redirect('/'.$apiKey);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($apiKey, $id)
    {
        $auth = makeAuth($apiKey);
        $url = $url = 'https://'. $auth['dc'] .'.api.mailchimp.com/3.0/lists/'. $id;

        $response = mailChimpRequest($auth, $url);

        return view('lists.show', ['list'=>$response, 'key'=> $apiKey]);
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
