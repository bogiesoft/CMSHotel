@extends('layouts.dashboard')
@section('content')

@include('modals.rooms.add-room-modal')
<?php $active = 'rooms';  ?>

<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                Rooms
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addRoomModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">

            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Name</th>
                <th>Max people</th>
                <th>Pets</th>
                <th>Price</th>
                <th>Order counter</th>
                <th>Options</th>
                </thead>

                @foreach($rooms as $room)
                    <tr id="room{{$room->id}}" @if($room->trashed())    class="text-muted" title="This room is not available for reservations"    @endif>
                        <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/rooms/{{$room->img}}" class="img-circle" style="width: 100%"> </td>
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
                            @if($room->trashed())
                                    <button type="submit" class="btn btn-sm btn-info restore-room" data-token="{{csrf_token()}}" value="{{$room->id}}" title="Make room available for reservation">
                                        <i class="fa fa-cart-plus" aria-hidden="false"></i>&nbsp;
                                    </button>
                            @else
                                <button type="submit" class="btn btn-sm btn-info delete-room" data-token="{{csrf_token()}}" value="{{$room->id}}">
                                    <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>&nbsp;
                                </button>
                            @endif

                        </td>
                    </tr>
                    @include('modals.rooms.show-room-modal')
                    @include('modals.rooms.edit-room-modal')
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection