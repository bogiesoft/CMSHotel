@extends('layouts.dashboard')
@section('header')
    <style>
        .btn-label{
            border:none;
            padding-top:4px;
            padding-bottom:4px;
            font-weight: bold;
            line-height: 1;
            font-size:75%
        }
    </style>
@endsection
@section('content')
    <!-- edit modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addRoomModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="text-center">Add a new room</h4>
                    <div style="padding: 1em">
                        <form action="/dashboard/rooms" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @include('admin.rooms.edit-create-form')
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" style="width: 100%">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- modal end -->
    <div class="row">
        <div class="well">
            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#addRoomModal">
                <i class="fa fa-plus " aria-hidden="true"></i>&nbsp; room
            </button>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <th>Name</th>
            <th>Max people</th>
            <th>Pets</th>
            <th>Price</th>
            <th>Order counter</th>
            <th>Options</th>
            </thead>

            @foreach($rooms as $room)
                <tr id="room{{$room->id}}">

                    <td>{{$room->name}}</td>
                    <td>{{$room->max_people}}</td>
                    <td>@if($room->pets){{'Yes'}}@else {{'No'}}@endif</td>
                    <td>${{$room->price}}</td>
                    <td>{{$room->counter}}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showRoomModal{{$room->id}}">
                            <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editRoomModal{{$room->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-info delete-room" data-token="{{csrf_token()}}" value="{{$room->id}}">
                            <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                        </button>
                    </td>

                </tr>

                <!-- show modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="showRoomModal{{$room->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                <div style="padding: 1em">
                                    @include('admin.rooms.show')
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- modal end -->

                <!-- edit modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="editRoomModal{{$room->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                <div style="padding: 1em">
                                    <form action="/dashboard/rooms/{{$room->id}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        {{method_field('patch')}}
                                        @include('admin.rooms.edit-create-form')
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info" style="width: 100%">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- modal end -->

            @endforeach
        </table>
    </div>



@endsection
@section('footer')
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
@endsection