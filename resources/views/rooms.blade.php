@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height:100vh;
            height: auto;
            padding-top: 25vh;
        }

    </style>
@endsection
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
                        <form action="/reserve" method="GET">
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#roomInfoModal{{$room->id}}">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                            <button class="btn btn-info" role="button" name="selected_room" value="{{$room->id}}">
                                <span class="glyphicon glyphicon-calendar"></span>
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        </form>
                        </p>

                    </div>
                </div>
            </div>
            <!-- /MODAL -->
            <div class="modal fade" id="roomInfoModal{{$room->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="text-center text-uppercase">{{$room->name}}</h3>
                        </div>
                        <div class="modal-body">
                            @include('room')
                        </div>
                        <div class="modal-footer">
                            <form action="/reserve" method="GET">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info" name="selected_room" value="{{$room->id}}">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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