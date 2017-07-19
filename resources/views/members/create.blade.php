@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/lists/{{$listId}}">List</a></li>
                <li class="breadcrumb-item"><a href="/lists/{{$listId}}/members/">Member</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <label class="col-md-4 control-label">List</label>
                    <div class="col-md-6">
                        <p>{{ $listId }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Member
                </div>

                <div class="panel-body">
                    <form action="/lists/{{ $listId }}/members" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email_address">Email</label>
                            <input type="text" class="form-control" id="email_address" name="email_address">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="subscribed">subscribed</option>
                                <option value="unsubscribed">unsubscribed</option>
                                <option value="cleaned">cleaned</option>
                                <option value="pending">pending</option>
                                <option value="transactional">transactional</option>
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
