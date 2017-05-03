@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                        <div class="form-group{{ $errors->has('data-center') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">API Key</label>

                            <div class="col-md-6">
                                <p>{{ $key }}</p>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New List
                </div>

                <div class="panel-body">
                    <form action="/{{ $key }}/lists" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="contact_company">Contact Company</label>
                            <input type="text" class="form-control" id="contact_company" name="contact_company">
                        </div>
                        <div class="form-group">
                            <label for="contact_address">Contact Address</label>
                            <input type="text" class="form-control" id="contact_address" name="contact_address">
                        </div>
                        <div class="form-group">
                            <label for="contact_city">Contact City</label>
                            <input type="text" class="form-control" id="contact_city" name="contact_city">
                        </div>
                        <div class="form-group">
                            <label for="contact_state">Contact State</label>
                            <input type="text" class="form-control" id="contact_state" name="contact_state">
                        </div>
                        <div class="form-group">
                            <label for="contact_zip">Contact Zip</label>
                            <input type="text" class="form-control" id="contact_zip" name="contact_zip">
                        </div>
                        <div class="form-group">
                            <label for="contact_country">Contact Country</label>
                            <input type="text" class="form-control" id="contact_country" name="contact_country">
                        </div>
                        <div class="form-group">
                            <label for="permission_reminder">Permission Reminder</label>
                            <input type="text" class="form-control" id="permission_reminder" name="permission_reminder">
                        </div>
                        <div class="form-group">
                            <label for="campaign_defaults_from_name">Campaign Default: From Name</label>
                            <input type="text" class="form-control" id="campaign_defaults_from_name" name="campaign_defaults_from_name">
                        </div>
                        <div class="form-group">
                            <label for="campaign_defaults_from_email">Campaign Default: From Email</label>
                            <input type="text" class="form-control" id="campaign_defaults_from_email" name="campaign_defaults_from_email">
                        </div>
                        <div class="form-group">
                            <label for="campaign_defaults_subject">Campaign Default: Subject</label>
                            <input type="text" class="form-control" id="campaign_defaults_subject" name="campaign_defaults_subject">
                        </div>
                        <div class="form-group">
                            <label for="campaign_defaults_language">Campaign Default: Language</label>
                            <input type="text" class="form-control" id="campaign_defaults_language" name="campaign_defaults_language">
                        </div>
                        <div class="form-group">
                            <label for="email_type_option">Email Type Option</label>
                            <select class="form-control" id="email_type_option" name="email_type_option">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
