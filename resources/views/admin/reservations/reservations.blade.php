@extends('layouts.dashboard')
@section('content')
    <?php $active = 'rooms';?>
    <div class="col-md-12">
        <a href="/dashboard/rooms" class="btn btn-default" style="margin-bottom: 1em">
            <i class="fa fa-btn fa-angle-left fa-fw"></i>&nbsp; Rooms
        </a>
    </div>
<div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                    Room reservations
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-xs btn-default pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                            &nbsp;  <i class="fa fa-caret-down"></i>
                            <i class="fa fa-caret-filter"></i>&nbsp; sort&nbsp;
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                            <li>
                                <a href="{{url('/dashboard/rooms/reservations/people/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-amount-{{$order}} fa-fw"></i> &nbsp;
                                    People
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/rooms/reservations/price/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-numeric-{{$order}} fa-fw"></i> &nbsp;
                                    Income
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/rooms/reservations/rating/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-numeric-{{$order}} fa-fw"></i> &nbsp;
                                    Rating
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/rooms/reservations/arrival/'. $order)}}"> &nbsp;
                                    <i class="fa fa-calendar-check-o fa-fw"></i> &nbsp;
                                    Arrival
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/rooms/reservations/departure/'. $order)}}"> &nbsp;
                                    <i class="fa fa-calendar-times-o fa-fw"></i> &nbsp;
                                    Departure
                                </a>
                            </li>
                        </ul>
                    </div>
                </h5>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>Room</th>
                        <th>People</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Rating</th>
                        <th>Income</th>
                        <th>Receipt</th>
                        </thead>
                        @foreach($reservations as $reservation)
                            <tr @if($reservation->passed()) class="text-muted" title="This reservation has passed"  @endif>
                                <td>{{$reservation->room->name}}</td>
                                <td>{{$reservation->people}}</td>
                                <td>{{$reservation->getFormattedArrivalDate()}}</td>
                                <td>{{$reservation->getFormattedDepartureDate()}}</td>
                                <td>
                                    @if($reservation->rating != 0)
                                        @for($i=1; $i <=$reservation->rating; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    @else
                                        {{'NR'}}
                                    @endif
                                </td>
                                <td>€{{$reservation->price()}}</td>
                                <td><a href="{{url('/receipt/' . $reservation->id)}}" target="_blank" class="label label-danger">PDF receipt</a></td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="col-md-12 text-center center-block">
                        {{$reservations->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection