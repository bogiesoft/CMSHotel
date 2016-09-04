@extends('layouts.dashboard')
@section('content')

@include('modals.drinks.add-drink-modal')
@include('modals.drinks.add-drink-type-modal')
<?php $active = 'drinks';  ?>
<div class="col-md-12">
    <a href="/dashboard/drinks/reservations" class="btn btn-default pull-right" style="margin-bottom: 1em">
        <i class="fa fa-btn fa-angle-right fa-fw"></i>&nbsp; Drink orders
    </a>
</div>

<div class="col-sm-12 col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Drinks
                <div class="dropdown pull-right">
                    <a class="btn btn-xs btn-info"
                       data-toggle="modal"
                       data-target="#addDrinkModal">
                        <i class="fa fa-plus"></i>&nbsp; add
                    </a>
                    <button class="btn btn-xs btn-info pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-caret-down"></i>
                        <i class="fa fa-caret-filter"></i>&nbsp; sort
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                        <li>
                            <a href="{{url('/dashboard/drinks/name/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                Drink
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/drinks/drink_type_id/' . $order)}}"> &nbsp;
                                <i class="fa fa-sort-amount-{{$order}} fa-fw"></i> &nbsp;
                                Type
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/dashboard/drinks/price/' . $order)}}"> &nbsp;
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
                <table class="table table-hover">
                    <thead>
                    <th>Name</th>
                    <th>Type</th>
                    <th>price</th>
                    <th>Image</th>
                    <th>Options</th>
                    </thead>
                    @foreach($drinks as $drink)
                        <tr id="drink{{$drink->id}}" @if($drink->trashed())    class="text-muted" title="This drink is not available for orders"    @endif>
                            <td>{{$drink->name}}</td>
                            <td>{{$drink->drink_type->name}}</td>
                            <td>{{$drink->price}}</td>
                            <td>@if($drink->img) {{$drink->img}}@else {{'No image'}} @endif</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showDrinkModal{{$drink->id}}">
                                    <i class="fa fa-eye fa-fw" aria-hidden="false" aria-label="show"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editDrinkModal{{$drink->id}}">
                                    <i class="fa fa-pencil-square-o fa-fw" aria-hidden="false" aria-label="edit"></i>
                                </a>

                                @if($drink->trashed())
                                    <button type="submit" class="btn btn-sm btn-info restore-drink" data-token="{{csrf_token()}}" value="{{$drink->id}}" title="Make drink available for orders">
                                        <i class="fa fa-cart-plus fa-fw" aria-hidden="false"></i>&nbsp;
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-sm btn-info delete-drink" data-token="{{csrf_token()}}" value="{{$drink->id}}">
                                        <i class="fa fa-trash fa-fw" aria-hidden="false" aria-label="delete"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                        <!--modal -->
                        @include('modals.drinks.edit-drink-modal')
                    <!--modal -->
                        @include('modals.drinks.show-drink-modal')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!--  most popular   -->
<div class="col-sm-12 col-md-4">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-fire" aria-hidden="true"></i> &nbsp;
                Most popular drink
            </h5>
        </div>
        <div class="panel-body">
            @if($most_popular_drink)
            <table class="table">
                <tr class="row text-center">
                    <td class="col-sm-8 col-md-6 h3" style="border:none">{{$most_popular_drink->name}}<br>
                        <small>
                            Ordered {{$most_popular_drink->counter}} times <br>
                        </small>
                    </td>
                </tr>
            </table>
            @else
                <h5 class="text-center">No drinks yet</h5>
            @endif
        </div>
    </div>
</div>

<!-- income by drink -->
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
                    <th>Income from drink orders</th>
                    <th>Number of orders</th>
                    </thead>
                    @foreach($drinks as $drink)
                        <tr id="drink-income{{$drink->id}}" @if($drink->trashed())    class="text-muted" title="This drink is not available for orders"    @endif>
                            <td>{{$drink->name}}</td>
                            <td>€{{$drink->price * $drink->counter}}</td>
                            <td>{{$drink->counter}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!--    types    -->
<div class="col-sm-12 col-md-6">
    <div class="panel panel-info" style="margin-bottom:0">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Drink Types
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addDrinkTypeModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                    <th>Type</th>
                    <th>Drinks:</th>
                    <th>Options</th>
                    </thead>
                    @foreach($types as $type)
                        <form action="/dashboard/drink-types/{{$type->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <tr id="drink-type{{$type->id}}">
                                <td>{{$type->name}}</td>
                                <td>{{$type->drinks()->count()}}</td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-info delete-drink-type" data-token="{{csrf_token()}}" value="{{$type->id}}">
                                        <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                    @include('modals.drinks.type-delete-error')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection