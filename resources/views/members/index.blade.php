@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/lists/{{$listId}}">List</a></li>
                <li class="breadcrumb-item active">Members</li>
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
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Members
                    <a href="/lists/{{ $listId }}/members/create" style="float:right">Add New Member</a>
                </div>

                <div class="panel-body">

                    @foreach($members as $member)
                        <p>
                            {{ $member['email_address'] }} - {{ $member['status'] }}
                            <a href="/lists/{{$listId}}/members/{{$member['id']}}/edit" style="float:right">Edit</a>
                        </p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
