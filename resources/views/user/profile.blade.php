@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height: 100vh;
            height: auto;
        }

        .block>.container{
            padding-top:15vh;
        }

        .tabs-div{
            width: 100%;
            border-bottom: 1px #dddddd solid;
        }

        .avatar-upload:hover.upload-text{
            visibility: visible;
        }

        .avatar-upload-form{
            padding: 1em;
        }
    </style>
@endsection
@section('content')

    <div class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-2 avatar-div">
                <a href="#" data-toggle="modal" data-target="#uploadAvatarModal">
                    <img src="/images/users/avatars/{{$user->img}}" class="img-responsive img-circle center-block avatar-upload">

                </a>
                <h4 class="text-center">{{ $user->name}} {{ $user->lastname }}</h4>
                <p class="text-center">{{$user->email}}</p>
                <a href="#" class="btn btn-sm btn-default center-block" data-toggle="modal" data-target="#userEditModal">
                    <i class="fa fa-cog fa-lg"></i> Settings
                </a>

            </div>

            <div class="col-md-10 center-block">
                <ul class="nav nav-tabs tabs-div" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#rooms" aria-controls="home" role="tab" data-toggle="tab">
                            <h5><i class="fa fa-bed" aria-hidden="true"> </i> Room reservations
                                <span class="label label-info hidden"> {{$user->reservations->count()}} </span>
                            </h5>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#tables" aria-controls="profile" role="tab" data-toggle="tab">
                            <h5><i class="fa fa-cutlery" aria-hidden="true"></i> Table reservations
                                <span class="label label-info hidden"> {{$user->table_reservations->count()}} </span>
                            </h5>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="rooms">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @foreach($reservations as $reservation)
                                    @include('user.reservations')
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tables">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @foreach($table_reservations as $reservation)
                                    @include('user.table-reservations')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="userEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        @include('user.edit-form')
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal fade" tabindex="-1" role="dialog" id="uploadAvatarModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="">
                        <form action="/avatar" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Choose avatar: </label>
                                <input type="file" name="img">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-link pull-right">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


@endsection
