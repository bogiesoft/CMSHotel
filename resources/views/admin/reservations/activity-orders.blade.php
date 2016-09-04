@extends('layouts.dashboard')
@section('content')
    <?php $active = 'activities';?>
    <div class="col-md-12">
        <a href="/dashboard/activities" class="btn btn-default" style="margin-bottom: 1em">
            <i class="fa fa-btn fa-angle-left fa-fw"></i>&nbsp; Activities
        </a>
    </div>



    <!-- meal orders -->
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                    Hotel activity orders
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-xs pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                            &nbsp;  <i class="fa fa-caret-down"></i>
                            <i class="fa fa-caret-filter"></i>&nbsp; sort &nbsp;
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                            <li>
                                <a href="{{url('/dashboard/activities/reservations/name/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    Activity
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/activities/reservations/counter/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-numeric-{{$order}} fa-fw"></i> &nbsp;
                                    Order count
                                </a>
                            </li>
                        </ul>
                    </div>

                </h5>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover text-left">
                        <thead>
                        <th>Room</th>
                        <th>User</th>
                        <th>Count</th>
                        <th>Total</th>
                        <th>Activity total</th>
                        </thead>
                        @foreach($activities as $activity)
                            <tr>
                                <td colspan="6" class="text-center">
                                    <strong class="text-info">
                                        {{$activity->name}}
                                    </strong>
                                </td>
                            </tr>
                        <?php
                            $counter = 0;
                            $i = 0;
                        ?>
                            @foreach($res = $activity->reservations()->selectRaw('*, count(*) as count')->groupBy('user_id', 'room_id')->get() as $reservation)
                                <tr>
                                    <td>{{$reservation->room->name}}</td>
                                    <td>{{$reservation->name}}</td>
                                    <td>{{$res[$i]->count}}</td>
                                    <td>€{{$activity->price}}</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                                    $counter += $res[$i]->count;
                                    $i++  ;
                                ?>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>{{$activity->reservations->count()}}</strong></td>
                                <td></td>
                                <td><strong>€{{$activity->getTotalActivityIncome()}}</strong></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection