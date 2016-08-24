@extends('layouts.dashboard')
@section('content')
@include('modals.users.add-user-modal')
<?php $active = 'users';  ?>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                Staff
                <a class="btn btn-xs btn-info pull-right"
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
                    <th>Last login</th>
                    <th>Options</th>
                    </thead>
                    @foreach($staff as $user)
                        @include('admin.users.user')
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="6">{{$staff->links()}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
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
                    <th>Last login</th>
                    <th>Options</th>
                    </thead>
                    @foreach($managers as $user)
                        @include('admin.users.user')
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="6">{{$managers->links()}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Admins
                <a class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#addUserModal"
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
                    <th>Last login</th>
                    </thead>
                    @foreach($admins as $user)
                        @include('admin.users.user')
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="6">{{$admins->links()}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Users
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                    <tfoot>
                        <tr>
                            <td colspan="6">{{$users->links()}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection