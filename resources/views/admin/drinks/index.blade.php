@extends('layouts.dashboard')
@section('content')
<div class="modal fade" id="addDrinkModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form id="" action="/dashboard/drinks" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('admin.drinks.edit-create-form')
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
    <button class="btn btn-default" data-toggle="modal" data-target="#addDrinkModal">
        <span>Add drink</span>
        <span class="glyphicon glyphicon-plus"></span>
        <span class="glyphicon glyphicon-glass"></span>
    </button>
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
        @foreach($drinks as $drink)
            <tr id="drink{{$drink->id}}">
                <td>{{$drink->name}}</td>
                <td>{{$drink->drink_type->name}}</td>
                <td>{{$drink->price}}</td>
                <td>@if($drink->img) {{$drink->img}}@else {{'No image'}} @endif</td>
                <td>
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#showDrinkModal{{$drink->id}}">
                        <i class="fa fa-eye" aria-hidden="false" aria-label="show"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editDrinkModal{{$drink->id}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                    </a>
                    <button type="submit" class="btn btn-sm btn-danger delete-drink" data-token="{{csrf_token()}}" value="{{$drink->id}}">
                        <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                    </button>
                </td>
            </tr>
            <!--modal -->
            <div class="modal fade" id="editDrinkModal{{$drink->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div style="padding: 1em">
                                <form action="/dashboard/drinks/{{$drink->id}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{method_field('patch')}}
                                    @include('admin.drinks.edit-create-form')
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
            <div class="modal fade" id="showDrinkModal{{$drink->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <div style="padding: 1em">
                                <form action="/dashboard/drinks/{{$drink->id}}" method="post" >
                                    {{csrf_field()}}
                                    {{method_field('patch')}}
                                    @include('admin.drinks.show')
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