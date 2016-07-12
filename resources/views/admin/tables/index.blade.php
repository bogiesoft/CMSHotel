@extends('layouts.dashboard')
@section('content')
    <div class="modal fade" id="addTableModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <div style="padding: 1em">
                        <form id="" action="/dashboard/tables" method="post">
                            {{csrf_field()}}
                            @include('admin.tables.edit-create-form')
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
        <button class="btn btn-default" data-toggle="modal" data-target="#addTableModal">
            <span>Add table</span>
            <span class="glyphicon glyphicon-plus"></span>
            <span class="glyphicon glyphicon-glass"></span>
        </button>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <th>Name</th>
            <th>Maximum people</th>
            <th>Options</th>
            </thead>
            @foreach($tables as $table)
                <tr id="table{{$table->id}}">
                    <td>{{$table->name}}</td>
                    <td>{{$table->people}}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editTableModal{{$table->id}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="false" aria-label="edit"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-danger delete-table" data-token="{{csrf_token()}}" value="{{$table->id}}">
                            <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                        </button>
                    </td>
                </tr>
                <!--modal -->
                <div class="modal fade" id="editTableModal{{$table->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <div style="padding: 1em">
                                    <form action="/dashboard/tables/{{$table->id}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('patch')}}
                                        @include('admin.tables.edit-create-form')
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info" style="width: 100%;">Update</button>
                                        </div>
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