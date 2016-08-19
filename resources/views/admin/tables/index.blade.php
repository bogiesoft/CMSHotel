@extends('layouts.dashboard')
@section('content')
    @include('modals.tables.add-table-modal')
    <?php $active = 'tables';  ?>

    <div class="col-sm-12 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h5 class="panel-title">
                    Tables
                    <a class="btn btn-xs btn-info pull-right"
                       data-toggle="modal"
                       data-target="#addTableModal">
                        <i class="fa fa-plus"></i>&nbsp; add
                    </a>
                </h5>
            </div>
            <div class="panel-body">

                <table class="table table-hover table-responsive">
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
                                <button type="submit" class="btn btn-sm btn-info delete-table" data-token="{{csrf_token()}}" value="{{$table->id}}">
                                    <i class="fa fa-trash" aria-hidden="false" aria-label="delete"></i>
                                </button>
                            </td>
                        </tr>
                        <!--modal -->
                        @include('modals.tables.edit-table-modal')
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection