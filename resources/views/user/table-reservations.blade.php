

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">{{$reservation->table->name}}</h4>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                Arrival: {{$reservation->arrival}}
            </li>
            <li class="list-group-item">
                Came for: {{$reservation->reservation_type->name}}
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