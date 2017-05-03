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
                    Lists
                    <a href="/{{ $key }}/lists/create" style="float:right">Add New List</a>
                </div>

                <div class="panel-body">

                    @foreach($members as $member)
                        <p>
                            {{ $member['email_address'] }} - {{ $member['status'] }}
                            <a href="/{{$key}}/lists/{{$listId}}/members/{{$member['id']}}/edit" style="float:right">Edit</a>
                        </p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
