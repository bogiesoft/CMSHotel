<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">{{$reservation->room->name}}</h4>
        </div>
        <div class="panel-body hidden" >
            @if($reservation->request)
                {{$reservation->request}}
            @else
                {{'No special requests'}}
            @endif
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                Arrival: {{$reservation->arrival}}
            </li>
            <li class="list-group-item">
                Departure: {{$reservation->departure}}
            </li>
            <li class="list-group-item">
                <span class="center-block">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </span>
            </li>
        </ul>

    </div>
</div>