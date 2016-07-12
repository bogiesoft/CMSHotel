@extends('layouts.dashboard')
@section('content')

<!--modal -->
<div class="modal fade" id="addMealModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form id="" action="/dashboard/meals" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('admin.meals.edit-create-form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="width: 100%;">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="row">
        <div class="well">
            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#addMealModal">
                <i class="fa fa-plus " aria-hidden="true"></i>&nbsp; room
            </button>
        </div>
    </div>
</div>
<div class="row">
<table class="table table-hover">
    <thead>
        <th>Name</th>
        <th>Type</th>
        <th>price</th>
        <th>Image</th>
        <th>Options</th>
    </thead>
    @foreach($meals as $meal)
    <tr id="meal{{$meal->id}}">
        <td>{{$meal->name}}</td>
        <td>{{$meal->meal_type->name}}</td>
        <td>{{$meal->price}}</td>
        <td>{{$meal->img}}</td>
        <td>

            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showMealModal{{$meal->id}}">
                <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
            </a>
            <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editMealModal{{$meal->id}}">
                <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
            </a>
            <button type="submit" class="btn btn-sm btn-danger delete-meal" data-token="{{csrf_token()}}" value="{{$meal->id}}">
                <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
            </button>
        </td>
    </tr>
    <!--modal -->
    <div class="modal fade" id="editMealModal{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div style="padding: 1em">
                        <form action="/dashboard/meals/{{$meal->id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('patch')}}
                            @include('admin.meals.edit-create-form')
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" style="width: 100%;">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--modal -->
    <div class="modal fade" id="showMealModal{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div style="padding: 1em">
                        <form action="/dashboard/meals/{{$meal->id}}" method="post" >
                            {{csrf_field()}}
                            {{method_field('patch')}}
                            @include('admin.meals.show')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</table>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
@endsection
