
<div class="panel panel-default @if($reservation->active() && !isset($norating)) {{'panel-info-border'}} @endif  hide-opacity bounceInLeft">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 equal-height">
                <div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-0">
                    <img src="/images/rooms/{{$reservation->room->img}}" class="img-responsive img-circle center-block">
                </div>
                <div class="col-xs-12 col-md-6 text-center">
                    <h4 class="text-center text-info">{{$reservation->room->name}}</h4>
                    @if($reservation->room->wifi)
                        <i class="fa fa-wifi fa-1x" title="Wi-Fi"></i>&nbsp
                    @endif
                    @if($reservation->room->kitchen)
                        <i class="fa fa-cutlery fa-1x" title="Kitchen"></i>&nbsp
                    @endif
                    @if($reservation->room->pets)
                        <i class="fa fa-paw fa-1x" title="Pets allowed"></i>&nbsp
                    @endif
                </div>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-md-12">
                <h6 class="text-center" title="Arrival">
                    <i class="fa fa-calendar-plus-o" style=" vertical-align: middle;"></i>&nbsp
                    {{$reservation->getFormattedArrivalDate()}}
                </h6>
                <h6 class="text-center"  title="Departure">
                    <i class="fa fa-calendar-minus-o" style=" vertical-align: middle;"></i>&nbsp
                    {{ $reservation->getFormattedDepartureDate()}}
                </h6>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-md-12">
                <div class="" style="width: 100%;">
                    <p class="text-center pull-left" style="width: 50%;">
                        <i class="fa fa-user"></i>&nbsp;
                        {{$reservation->people . ' person/people'}}
                    </p>
                    <div class="wrap">
                        <button value="{{$reservation->id}}" class="receipt-button btn btn-sm btn-link pull-right" style="width: 50%;"
                                data-toggle="popover"
                                data-placement="auto right"
                                data-html="true">
                        <span>
                            <i class="fa fa-money"></i>&nbsp;
                            {{$reservation->price}}
                        </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 class="text-center">
                <span class="text-info">Booked on name:</span>
                {{$reservation->name}}
                <small> ({{$reservation->email}})</small>
                </h6>
            </div>
        </div>
        @if(!isset($norating))
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <form method="POST"
                          action="reservation/{{$reservation->id}}/rating"
                          data-reservation ="{{$reservation->id}}"
                          data-type = "reservation">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$reservation->id}}" class="reservation-id">
                        <div
                                id="reservation-rating-group{{$reservation->id}}"
                                class="btn-group @if(!$reservation->passed()) {{'rating-disabled'}}    @endif"
                                data-rating ="{{$reservation->rating}}">
                            @for($i=1;$i<=$reservation->rating;$i++)
                                <button name="rating" type="submit" value="{{$i}}" class="btn btn-link change-rating rating{{$i}}">
                                    <span class="fa fa-star"></span>
                                </button>
                            @endfor
                            @for($i = $reservation->rating+1;$i<=5;$i++)
                                <button name="rating" type="submit" value="{{$i}}"  class="btn btn-link change-rating rating{{$i}}" data-url="reservations">
                                    <span class="fa fa-star-o"></span>
                                </button>
                            @endfor
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
