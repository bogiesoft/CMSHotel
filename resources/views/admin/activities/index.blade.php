@extends('layouts.dashboard')
@section('content')

@include('modals.activities.add-activity-modal')
<?php $active = 'activities';  ?>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-shopping-cart"></i>&nbsp;
                Activities
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addActivityModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th class="hidden-xs hidden-sm"></th>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Text</th>
                    <th>Options</th>
                    </thead>

                    @foreach($activities as $activity)
                        <tr id="activity{{$activity->id}}" @if($activity->trashed()) class="text-muted" title="This activity is not available for reservations"    @endif>
                            <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/activities/{{$activity->img}}" class="img-circle" style="width: 100%"> </td>
                            <td>{{$activity->name}}</td>
                            <td>{{$activity->duration}}</td>
                            <td>{{$activity->price}}</td>
                            <td>{{substr($activity->text, 0, 50) . '...'}}</td>
                            <td>
                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#showActivityModal{{$activity->id}}">
                                    <i class="fa fa-eye fa-fw" aria-hidden="false" aria-label="show"></i>
                                </button>
                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#editActivityModal{{$activity->id}}">
                                    <i class="fa fa-pencil-square-o fa-fw" aria-hidden="false" aria-label="edit"></i>
                                </button>
                                @if($activity->trashed())
                                    <button type="submit" class="btn btn-sm btn-info restore-activity" data-token="{{csrf_token()}}" value="{{$activity->id}}" title="Make activity available for reservation">
                                        <i class="fa fa-cart-plus fa-fw" aria-hidden="false"></i>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-info delete-activity" data-token="{{csrf_token()}}" value="{{$activity->id}}">
                                        <i class="fa fa-trash fa-fw" aria-hidden="false" aria-label="delete"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>
                        @include('modals.activities.show-activity-modal')
                        @include('modals.activities.edit-activity-modal')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-12 col-md-6">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-fire" aria-hidden="true"></i> &nbsp;
                Most popular activity
            </h5>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr class="row text-center">
                    <td class="col-sm-4 col-md-6 center-block" style="border:none">
                        <img src="/images/activities/{{$most_popular_activity->img}}" class="img-responsive img-circle">
                    </td>
                    <td class="col-sm-8 col-md-6 h3" style="border:none">{{$most_popular_activity->name}}<br>
                        <small>
                            Ordered {{$most_popular_activity->counter}} times <br>
                        </small>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-money" aria-hidden="true"></i> &nbsp;
                Income
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <th>Name</th>
                    <th>Income from activity reservations</th>
                    <th>Number of orders</th>
                    </thead>
                    @foreach($activities as $activity)
                        <tr id="activity-income{{$activity->id}}" @if($activity->trashed())    class="text-muted" title="This activity is not available for reservations"    @endif>
                            <td>{{$activity->name}}</td>
                            <td>€{{$activity->getTotalActivityIncome()}}</td>
                            <td>{{$activity->counter}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- activity orders -->
<div class="col-sm-12 col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                Activity orders
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead >
                    <th>&nbsp;</th>
                    <th>Activity</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Order total</th>
                    </thead>

                    @foreach($reservations as $reservation)
                        <?php $orders = $reservation->activities()->orderBy('pivot_created_at', 'asc')->get() ?>
                        @if(!$orders->isEmpty())
                            <?php $total = 0  ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Order for
                                    <strong class="text-info">
                                        <?php $res = $orders->first()->reservations()->find($reservation->id)  ?>
                                        {{$res->room->name}}
                                    </strong>
                                    on name
                                    <strong>
                                        {{$res->name}}
                                    </strong>
                                </td>
                            </tr>
                            @foreach($orders as $activity)
                                <?php $total += $activity->price  ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>{{$activity->name}}</td>
                                    <td>{{(new \Carbon\Carbon($activity->pivot->created_at, 'Europe/London'))->toDayDateTimeString()}}</td>
                                    <td>€{{$activity->price}}</td>
                                    <th>&nbsp;</th>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="4"></td>
                                <td><strong>Total: €{{$total}}</strong></td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection