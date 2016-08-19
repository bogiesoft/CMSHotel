@extends('layouts.dashboard')
@section('content')
@include('modals.users.add-user-modal')
<?php $active = 'users';  ?>

<div class="col-sm-6 col-md-3">
    <div class="alert alert-info">
        <div class="row">
            <div class="col-sm-0 col-md-2 hidden-xs hidden-sm text-center">
                <i class="fa fa-user-md fa-4x"></i>
            </div>
            <h3 class="col-sm-12 col-md-10 text-center">
                <strong>
                    {{count(\Illuminate\Foundation\Auth\User::where('role_id', '=', '2')->get())}}
                    Users
                </strong>
            </h3>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="alert alert-warning">
        <div class="row">
            <div class="col-sm-0 col-md-2 hidden-xs hidden-sm text-center">
                <i class="fa fa-user-md fa-4x"></i>
            </div>
            <h3 class="col-sm-12 col-md-10 text-center">
                <strong>
                    {{count(\Illuminate\Foundation\Auth\User::where('role_id', '=', '3')->get())}}
                    Staff
                </strong>
            </h3>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="alert alert-warning">
        <div class="row">
            <div class="col-sm-0 col-md-2 hidden-xs hidden-sm text-center">
                <i class="fa fa-user-md fa-4x"></i>
            </div>
            <h3 class="col-sm-12 col-md-10 text-center">
                <strong>
                    {{count(\Illuminate\Foundation\Auth\User::where('role_id', '=', '4')->get())}}
                    Managers
                </strong>
            </h3>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="alert alert-danger">
        <div class="row">
            <div class="col-sm-0 col-md-2 hidden-xs hidden-sm text-center">
                <i class="fa fa-user-md fa-4x"></i>
            </div>
            <h3 class="col-sm-12 col-md-10 text-center">
                <strong>
                    {{count(\Illuminate\Foundation\Auth\User::where('role_id', '=', '1')->get())}}
                    Admin
                </strong>
            </h3>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Users
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Lastname</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Last login</th>
                <th>Options</th>
                </thead>
                @foreach($users as $user)
                    @include('admin.users.user')
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h5 class="panel-title">
                Staff
                <a class="btn btn-xs btn-warning pull-right"
                   data-toggle="modal"
                   data-target="#addUserModal"
                   data-value="3"
                   data-role="staff">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Lastname</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Last login</th>
                <th>Options</th>
                </thead>
                @foreach($staff as $user)
                    @include('admin.users.user')
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Managers
                <a class="btn btn-xs btn-warning pull-right"
                   data-toggle="modal"
                   data-target="#addUserModal"
                   data-value="4"
                   data-role="manager">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Lastname</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Last login</th>
                <th>Options</th>
                </thead>
                @foreach($managers as $user)
                    @include('admin.users.user')
                @endforeach
            </table>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Admins
                <a class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target="#addUserModal"
                   data-value="1"
                   data-role="admin">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Lastname</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Last login</th>
                </thead>
                @foreach($admins as $user)
                    @include('admin.users.user')
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection