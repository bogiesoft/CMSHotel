@extends('layouts.dashboard')
@section('content')
    @include('modals.users.add-user-modal')
    <?php $active = 'users';  ?>

    <div class="col-md-12">
        <a href="/dashboard/users" class="btn btn-default" style="margin-bottom: 1em">
            <i class="fa fa-btn fa-angle-left fa-fw"></i>&nbsp; Back
        </a>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                    Users
                    <div class="dropdown pull-right">
                        <button class="btn btn-xs pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-caret-down"></i>
                            <i class="fa fa-caret-filter"></i>&nbsp; sort
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                            <li>
                                <a href="{{url('/dashboard/users/users/name/' . $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    Name
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/users/users/lastname/' . $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    Lastname
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/users/users/email/' . $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    E-mail
                                </a>
                            </li>
                        </ul>
                    </div>
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
                        <th>Last active</th>
                        <th>Options</th>
                        </thead>
                        @foreach($users as $user)
                            @include('admin.users.user')
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center center-block">
        {{$users->links()}}
    </div>


@endsection