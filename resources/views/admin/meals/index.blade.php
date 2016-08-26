@extends('layouts.dashboard')
@section('content')


@include('modals.meals.add-meal-modal')
@include('modals.meals.add-meal-type-modal')
<?php $active = 'meals';  ?>





<div class="col-sm-12 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Meals
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addMealModal">
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
                    <th>Type</th>
                    <th>price</th>
                    <th>Options</th>
                    </thead>
                    @foreach($meals as $meal)
                        <tr id="meal{{$meal->id}}" @if($meal->trashed())    class="text-muted" title="This meal is not available for orders"    @endif>
                            <td class="hidden-xs hidden-sm" style="width: 10%;"><img src="/images/meals/{{$meal->img}}" class="img-circle" style="width: 100%"> </td>
                            <td>{{$meal->name}}</td>
                            <td>{{$meal->meal_type->name}}</td>
                            <td>€{{$meal->price}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showMealModal{{$meal->id}}">
                                    <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editMealModal{{$meal->id}}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                                </a>
                                @if($meal->trashed())
                                    <button type="submit" class="btn btn-sm btn-info restore-meal" data-token="{{csrf_token()}}" value="{{$meal->id}}" title="Make meal available for orders">
                                        <i class="fa fa-cart-plus" aria-hidden="false"></i>&nbsp;
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-info delete-meal" data-token="{{csrf_token()}}" value="{{$meal->id}}">
                                        <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>&nbsp;
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @include('modals.meals.edit-meal-modal')
                        @include('modals.meals.show-meal-modal')
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">{{$meals->links()}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- most popular meal -->
<div class="col-sm-12 col-md-4">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-fire" aria-hidden="true"></i> &nbsp;
                Most popular meal
            </h5>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr class="row text-center">
                    <td class="col-sm-4 col-md-6 center-block" style="border:none">
                        <img src="/images/meals/{{$most_popular_meal->img}}" class="img-responsive img-circle">
                    </td>
                    <td class="col-sm-8 col-md-6 h3" style="border:none">{{$most_popular_meal->name}}<br>
                        <small>
                            Ordered {{$most_popular_meal->counter}} times <br>
                        </small>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- income by meal -->
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
                    <th>Income from meal orders</th>
                    <th>Number of orders</th>
                    </thead>
                    @foreach($meals as $meal)
                        <tr id="meal-income{{$meal->id}}" @if($meal->trashed())    class="text-muted" title="This meal is not available for orders"    @endif>
                            <td>{{$meal->name}}</td>
                            <td>€{{$meal->getTotalMealIncome()}}</td>
                            <td>{{$meal->counter}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!-- meal types -->
<div class="col-sm-12 col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Meal types
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addMealTypeModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th>Type</th>
                    <th>Meals:</th>
                    <th>Options</th>
                    </thead>
                    @foreach($types as $type)
                        <form action="/dashboard/meal-types/{{$type->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <tr id="meal-type{{$type->id}}">
                                <td>{{$type->name}}</td>
                                <td>{{$type->meals()->count()}}</td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-info delete-meal-type" data-token="{{csrf_token()}}" value="{{$type->id}}">
                                        <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                        @include('modals.meals.type-delete-error')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="clearfix"></div>

<!-- meal orders -->
<div class="col-sm-12 col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                Meal orders
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead >
                    <th>&nbsp;</th>
                    <th>Meal</th>
                    <th>Servings</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Order total</th>
                    </thead>

        @foreach($reservations as $reservation)
            <?php $orders = $reservation->meals()->orderBy('pivot_created_at', 'asc')->get() ?>
            @if(!$orders->isEmpty())
                <?php $total = 0  ?>
                <tr>
                    <td colspan="6" class="text-center">
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
                @foreach($orders as $meal)
                    <?php $total += $meal->price * $meal->pivot->count  ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>{{$meal->name}}</td>
                        <td>{{$meal->pivot->count}}</td>
                        <td>{{(new \Carbon\Carbon($meal->pivot->created_at, 'Europe/London'))->toDayDateTimeString()}}</td>
                        <td>€{{$meal->price * $meal->pivot->count}}</td>
                        <th>&nbsp;</th>
                    </tr>
                @endforeach

                    <tr>
                        <td colspan="5"></td>
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
