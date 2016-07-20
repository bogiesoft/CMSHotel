<div class="col-sm-12 col-md-10 col-md-offset-1">

    @if(isset($res))
        <div class="row">
            <h2 class="text-center">Reservation successful</h2>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h6>
                                <i class="fa fa-user" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp&nbsp
                                {{$res->user->name . ' ' . $res->user->lastname}}
                            </h6>
                            <h6>
                                <i class="fa fa-envelope-o" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$res->user->email}}
                            </h6>
                            <h6>
                                <i class="fa fa-calendar" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$arrival->toFormattedDateString()}} - {{$departure->toFormattedDateString()}}
                            </h6>
                            <h6>
                                <i class="fa fa-users" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$res->people}} @if($res->people == 1) {{' person'}}   @else {{' people'}} @endif
                            </h6>

                            <h6>
                                <i class="fa fa-money" aria-hidden="true" style="vertical-align: middle;"></i>&nbsp;
                                {{$res->price}}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img src="/images/rooms/{{$res->room->img}}" class="img-responsive img-rounded">
                        </div>
                        <div class="col-md-8">
                            <h4>{{$res->room->name}}</h4>
                            <p>{{$res->room->text}}</p>
                            <p class="text-capitalize">
                                <i class="fa fa-list" aria-hidden="true"></i>&nbsp;
                                @if($res->room->wifi){{'wifi'}}@endif
                                @if($res->room->kitchen){{', kitchen'}}  @endif
                                @if($res->room->balcony){{', balcony'}}  @endif
                                @if($res->room->pets){{', pets'}}  @endif
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
