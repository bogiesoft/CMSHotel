@extends('layouts.dashboard')
@section('content')


@include('modals.meals.add-meal-modal')
@include('modals.meals.add-meal-type-modal')
<?php $active = 'meals';  ?>
<div class="col-md-8">
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
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Name</th>
                <th>Type</th>
                <th>price</th>
                <th>Options</th>
                </thead>
                @foreach($meals as $meal)
                    <tr id="meal{{$meal->id}}" @if($meal->trashed())    class="text-muted" title="This meal is not visible on page"    @endif>
                        <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/meals/{{$meal->img}}" class="img-circle" style="width: 100%"> </td>
                        <td>{{$meal->name}}</td>
                        <td>{{$meal->meal_type->name}}</td>
                        <td>{{$meal->price}}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showMealModal{{$meal->id}}">
                                <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editMealModal{{$meal->id}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                            </a>
                            @if($meal->trashed())
                                <button type="submit" class="btn btn-sm btn-info restore-meal" data-token="{{csrf_token()}}" value="{{$meal->id}}" title="Make meal visible on page">
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
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-primary" style="margin-bottom:0">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Meal Types
                <a class="btn btn-xs btn-primary pull-right"
                   data-toggle="modal"
                   data-target="#addMealTypeModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th>Type</th>
                <th>Meals:</th>
                <th>Options</th>
                </thead>
                @foreach($types as $type)
                    <tr id="meal-type{{$type->id}}">
                        <td>{{$type->name}}</td>
                        <td>{{$type->meals()->count()}}</td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary delete-meal-type" data-token="{{csrf_token()}}" value="{{$type->id}}">
                                <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection
