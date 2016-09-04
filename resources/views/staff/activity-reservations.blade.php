@extends('layouts.dashboard')
@section('content')

    @include('modals.past-a-reservations')
    @include('modals.future-a-reservations')

    <?php $active = 'activity-reservations';  ?>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-shopping-cart"></i>&nbsp;
                    Today's In-room orders
                    <button class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#future-reservations" title="Tomorrow's reservations">
                        <i class="glyphicon glyphicon-plus"></i>
                        <i class="glyphicon glyphicon-calendar"></i>
                    </button>
                    <button class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#past-reservations" title="Yesterday's reservations">
                        <i class="glyphicon glyphicon-minus"></i>
                        <i class="glyphicon glyphicon-calendar"></i>
                    </button>
                </h5>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Charged to room</th>
                    <th>Name</th>
                    </thead>
                    @foreach($activities as $activity)

                        @foreach(
                            $activity->reservations()->where([
                                ['time', '>=',$now],
                                ['time', '<', $now->copy()->addDay()]
                                ])->get()
                            as $order)

                            <tr id="order{{$order->pivot->id}}">
                                <td>{{$activity->name}}</td>
                                <td>{{(new \Carbon\Carbon($order->pivot->time))->toDayDateTimeString()}}</td>
                                <td>{{$order->room->name}}</td>
                                <td>{{$order->name}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>


@endsection