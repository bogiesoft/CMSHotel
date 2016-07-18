<div class="col-sm-12 col-md-10 col-md-offset-1">
    <?php
    if(\Auth::user()->reservations() != null){
        $reservation = \Auth::user()->reservations()->orderBy('created_at', 'descending')->first();
        $arrival = new \Carbon\Carbon($reservation->arrival);
        $departure = new \Carbon\Carbon($reservation->departure);

    }
    ?>
    @if(isset($reservation))
        <div class="row">
            <h2 class="text-center">Reservation successful</h2>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h6>
                                <i class="fa fa-user" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp&nbsp
                                {{$reservation->user->name . ' ' . $reservation->user->lastname}}
                            </h6>
                            <h6>
                                <i class="fa fa-envelope-o" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$reservation->user->email}}
                            </h6>
                            <h6>
                                <i class="fa fa-calendar" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$arrival->toFormattedDateString()}} - {{$departure->toFormattedDateString()}}
                            </h6>
                            <h6>
                                <i class="fa fa-users" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$reservation->people}} @if($reservation->people == 1) {{' person'}}   @else {{' people'}} @endif
                            </h6>

                            <h6>
                                <i class="fa fa-money" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$reservation->price}}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img src="/images/rooms/{{$reservation->room->img}}" class="img-responsive img-rounded">
                        </div>
                        <div class="col-md-8">
                            <h4>{{$reservation->room->name}}</h4>
                            <p>{{$reservation->room->text}}</p>
                            <p class="text-capitalize">
                                <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                @if($reservation->room->wifi){{'wifi'}}@endif
                                @if($reservation->room->kithen){{', kitchen'}}  @endif
                                @if($reservation->room->balcony){{', balcony'}}  @endif
                                @if($reservation->room->pets){{', pets'}}  @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="center-block">
                <a href="{{url('/reservation')}}" class="btn btn-link">Back</a>
                <a href="{{url('/profile')}}" class="btn btn-link">My account</a>
            </div>
        </div>
    @endif
</div>
