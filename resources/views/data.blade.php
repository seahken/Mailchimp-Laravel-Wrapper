@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Home</li>

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

                    @foreach($lists as $list)
                        <p>
                            {{ $list['name'] }}
                            <a href="/{{$key}}/lists/{{$list['id']}}" style="float:right">Details</a>
                        </p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
