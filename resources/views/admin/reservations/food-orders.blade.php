@extends('layouts.dashboard')
@section('content')
    <?php $active = 'meals';?>
    <div class="col-md-12">
        <a href="/dashboard/meals" class="btn btn-default" style="margin-bottom: 1em">
            <i class="fa fa-btn fa-angle-left fa-fw"></i>&nbsp; Meals
        </a>
    </div>



    <!-- meal orders -->
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                    Meal orders
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-xs pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                            &nbsp;  <i class="fa fa-caret-down"></i>
                            <i class="fa fa-caret-filter"></i>&nbsp; sort &nbsp;
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                            <li>
                                <a href="{{url('/dashboard/meals/reservations/name/'. $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    Meal
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/meals/reservations/counter/'. $order)}}"> &nbsp;
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
                        </thead>
                        @foreach($meals as $meal)
                            <?php  $total = 0 ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <strong class="text-info">
                                        {{$meal->name}}
                                    </strong>
                                </td>
                            </tr>
                            @foreach($meal->reservations()->get() as $reservation)
                                <?php $total += $meal->price * $reservation->pivot->count  ?>
                                <tr>
                                    <td>{{$reservation->room->name}}</td>
                                    <td>{{$reservation->name}}</td>
                                    <td>{{$reservation->pivot->count}}</td>
                                    <td>€{{$meal->price * $reservation->pivot->count}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>{{$meal->counter}}</strong></td>
                                <td><strong>€{{$meal->getTotalMealIncome()}}</strong></td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection