@extends('layouts.dashboard')
@section('content')


@include('modals.meals.add-meal-modal')
@include('modals.meals.add-meal-type-modal')
<?php $active = 'meals';  ?>
<div class="col-md-12">
    <a href="/dashboard/meals/reservations" class="btn btn-default pull-right" style="margin-bottom: 1em">
        <i class="fa fa-btn fa-angle-right fa-fw"></i>&nbsp; Meal orders
    </a>
</div>

<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Meals
                <div class="dropdown pull-right">
                    <a class="btn btn-xs btn-info "
                       data-toggle="modal"
                       data-target="#addMealModal">
                        <i class="fa fa-plus"></i>&nbsp; add
                    </a>

                    <button class="btn btn-xs btn-info pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-caret-down"></i>
                        <i class="fa fa-caret-filter"></i>&nbsp; sort
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                        <li>
                            <a href="{{url('/dashboard/meals/name/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                Meal
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/meals/meal_type_id/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-amount-{{$order}} fa-fw"></i> &nbsp;
                                Type
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/meals/price/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-numeric-{{$order}} fa-fw"></i> &nbsp;
                                Price
                            </a>
                        </li>
                    </ul>
                </div>

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
                            <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/meals/{{$meal->img}}" class="img-circle" style="width: 100%"> </td>
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
                </table>
                <div class="col-md-12 center-block text-center">
                    {{$meals->links()}}
                </div>
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
            @if($most_popular_meal)
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
            @else
                <h5 class="text-center">No meals yet</h5>
            @endif
        </div>
    </div>
</div>

<!-- meal types -->
<div class="col-sm-12 col-md-8">
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
<!-- income by meal -->
<div class="col-sm-12 col-md-12">
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
                            <td>€{{$meal->price * $meal->counter}}</td>
                            <td>{{$meal->counter}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection