@extends('layouts.dashboard')
@section('content')
    <?php $active = 'activity-reservations';  ?>
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-shopping-cart"></i>&nbsp;
                    In-room orders
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
                        @foreach($activity->reservations()->get() as $order)
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
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection