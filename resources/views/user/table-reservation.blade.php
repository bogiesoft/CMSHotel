<div class="panel panel-default hide-opacity bounceInLeft">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">
                    <span class="text-info">Booked on name:</span>
                    {{$reservation->name}}</h5>
            </div><hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 class="text-center">
                    {{$reservation->table->name}}
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h6 class="text-center"  title="Arrival">
                    <i class="fa fa-calendar-plus-o" style=" vertical-align: middle;"></i>&nbsp
                    {{ $reservation->getFormattedArrivalDate() }}
                </h6>
            </div>
        </div> <hr>

        <div class="row">
            <div class="col-md-12">
                <h5 class="text-info text-center">
                    <span title="{{$reservation->people}} people"><strong>{{$reservation->people}}</strong></span>
                    @if($reservation->reservation_type->name == 'Food')
                        <i class="fa fa-cutlery" title="Came for food"></i>
                    @else
                        <i class="fa fa-glass" title="Came for Drinks"></i>
                    @endif
                </h5>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <form method="POST"
                      action="table-reservation/{{$reservation->id}}/rating"
                      data-reservation ="{{$reservation->id}}"
                      data-type = "table-reservation">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$reservation->id}}" class="reservation-id">
                    <div id="table-reservation-rating-group{{$reservation->id}}"
                         class="btn-group @if(!$reservation->passed()) {{'rating-disabled'}}    @endif"
                         data-rating ="{{$reservation->rating}}">
                        @for($i=1;$i<=$reservation->rating;$i++)
                            <button name="rating" type="submit" value="{{$i}}" class="btn btn-link change-rating rating{{$i}}">
                                <span class="fa fa-star"></span>
                            </button>
                        @endfor
                        @for($i = $reservation->rating+1;$i<=5;$i++)
                            <button name="rating" type="submit" value="{{$i}}"  class="btn btn-link change-rating rating{{$i}}">
                                <span class="fa fa-star-o"></span>
                            </button>
                        @endfor
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>