@extends('layouts.app')
@section('content')
<div class="block">
    <div class="container">
        <?php   $delay = 0; ?>
    @foreach($rooms as $room)
    <div class="col-sm-6 col-md-4 hide-opacity bounceInLeft"
         style="
                 -webkit-animation-delay: {{$delay}}s;
                 -moz-animation-delay: {{$delay}}s;
                 -o-animation-delay: {{$delay}}s;
                 animation-delay: {{$delay}}s;">

    <div class="thumbnail">
        <img src="/images/rooms/{{$room->img}}" alt="{{$room->name}}">
        <div class="caption">
            <h3>{{$room->name}}</h3>
            <p class="equal-height">{{mb_strimwidth($room->text, 0, 100, "...")}}</p>
            <p>
            <form action="{{url('/reservation')}}" method="GET">
                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#showRoomModal{{$room->id}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </button>
                @if(\Auth::check())
                    <button type="submit" class="btn btn-info" name="selected_room" value="{{$room->id}}">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                @endif
            </form>
            </p>
        </div>
    </div>
    </div>
    <?php $delay += 0.5  ?>
    @include('modals.rooms.show-room-modal')
    @endforeach
        <div class="col-md-12 text-center center-block">
            {{$rooms->links()}}
        </div>
    </div>
</div>
@endsection