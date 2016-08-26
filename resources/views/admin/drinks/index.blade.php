@extends('layouts.dashboard')
@section('content')

@include('modals.drinks.add-drink-modal')
@include('modals.drinks.add-drink-type-modal')
<?php $active = 'drinks';  ?>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-list-alt" style="vertical-align: middle"></i>&nbsp;
                Drinks
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addDrinkModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
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
<div class="col-md-4">
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
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection