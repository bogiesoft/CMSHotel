@extends('layouts.dashboard')
@section('content')
@include('modals.users.add-user-modal')
<?php $active = 'users';  ?>
<div class="col-md-12">
    <a href="/dashboard/users/users" class="btn btn-default pull-right" style="margin-bottom: 1em">
        <i class="fa fa-btn fa-angle-right fa-fw"></i>&nbsp; Users
    </a>
</div>

<!--  manager  -->
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-building-o" style="vertical-align: middle"></i>&nbsp;
                Managers
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addUserModal"
                   data-value="4"
                   data-role="manager">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th class="hidden-xs hidden-sm"></th>
                    <th>Lastname</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Last active</th>
                    <th>Options</th>
                    </thead>
                    @foreach($managers as $user)
                        @include('admin.users.user')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!--  staff  -->
<div class="col-sm-12 col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-building-o" style="vertical-align: middle"></i>&nbsp;
                Staff
                <a class="btn btn-xs pull-right"
                   data-toggle="modal"
                   data-target="#addUserModal"
                   data-value="3"
                   data-role="staff">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th class="hidden-xs hidden-sm"></th>
                    <th>Lastname</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Last active</th>
                    <th>Options</th>
                    </thead>
                    @foreach($staff as $user)
                        @include('admin.users.user')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!--  manager  -->
<div class="col-sm-12 col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-wrench" style="vertical-align: middle"></i>&nbsp;
                Administrators
                <a class="btn btn-xs pull-right" data-toggle="modal" data-target="#addUserModal"
                   data-value="1"
                   data-role="admin">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th class="hidden-xs hidden-sm"></th>
                    <th>Lastname</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Last active</th>
                    </thead>
                    @foreach($admins as $user)
                        @include('admin.users.user')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>



@endsection