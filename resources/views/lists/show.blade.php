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
