@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <label class="col-md-4 control-label">API Key</label>
                    <div class="col-md-6">
                        <p>{{ $key }}</p>
                    </div>
                    <label class="col-md-4 control-label">Member</label>
                    <div class="col-md-6">
                        <p>{{ $member['email_address'] }}</p>
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
                    <form action="/{{ $key }}/lists/{{ $listId }}/members/{{ $member['email_address'] }}" method="POST">
                        <input type="hidden" name="_method" value="PATCH">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email_address">Email</label>
                            <input type="text" class="form-control" id="email_address" name="email_address" value="{{ $member['email_address'] }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="subscribed" {{ $member['status'] == 'subscribed' ? 'selected' : ''}}>subscribed</option>
                                <option value="unsubscribed" {{ $member['status'] == 'unsubscribed' ? 'selected' : ''}}>unsubscribed</option>
                                <option value="cleaned" {{ $member['status'] == 'cleaned' ? 'selected' : ''}}>cleaned</option>
                                <option value="pending" {{ $member['status'] == 'pending' ? 'selected' : ''}}>pending</option>
                                <option value="transactional" {{ $member['status'] == 'transactional' ? 'selected' : ''}}>transactional</option>
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
