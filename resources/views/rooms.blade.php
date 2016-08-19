@extends('layouts.app')
@section('content')
<div class="block">
    <div class="container">
    @foreach($rooms as $room)
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="/images/rooms/{{$room->img}}" alt="{{$room->name}}">
        <div class="caption">
            <h3>{{$room->name}}</h3>
            <p class="text-block">{{mb_strimwidth($room->text, 0, 100, "...")}}</p>
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
    @include('modals.rooms.show-room-modal')
    @endforeach
    </div>
</div>
@endsection
@section('footer')
    <script>
        function equalHeight(group) {
            var tallest = 0;
            group.each(function() {
                var thisHeight = $(this).height();
                if(thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            group.each(function() { $(this).height(tallest); });
        }

        $(document).ready(function() {
            equalHeight($(".text-block"));
        });
    </script>
@endsection