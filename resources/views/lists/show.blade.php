@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/{{$key}}">Home</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <label class="col-md-4 control-label">API Key</label>

                    <div class="col-md-6">
                        <p>{{ $key }}</p>
                    </div>

                    <label class="col-md-4 control-label">Member Count</label>
                    <div class="col-md-6">
                        <p>{{ $list['stats']['member_count'] }}</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $list['name'] }}

                </div>

                <div class="panel-body">
                    <p><a href="/{{ $key }}/lists/{{ $list['id'] }}/members/create">Add New Members</a></p>
                    <p><a href="/{{ $key }}/lists/{{ $list['id'] }}/members">See Existing Members</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
