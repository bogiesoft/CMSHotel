@extends('layouts.dashboard')
@section('content')
    @include('modals.tables.add-table-modal')
    <?php $active = 'tables';  ?>
    <div class="col-sm-12 col-md-6 pull-right">
        <a href="/dashboard/tables/reservations" class="btn btn-default pull-right" style="margin-bottom: 1em">
            <i class="fa fa-btn fa-angle-right fa-fw"></i>&nbsp; Table reservations
        </a>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h5 class="panel-title">
                    Tables
                    <div class="dropdown pull-right">
                        <a class="btn btn-xs btn-info"
                           data-toggle="modal"
                           data-target="#addTableModal">
                            <i class="fa fa-plus"></i>&nbsp; add
                        </a>

                        <button class="btn btn-xs btn-info pull-right dropdown-toggle" id="dropdownSort" data-toggle="dropdown"aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-caret-down"></i>
                            <i class="fa fa-caret-filter"></i>&nbsp; sort
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownSort">
                            <li>
                                <a href="{{url('/dashboard/tables/name/' . $order)}}"> &nbsp;
                                    <i class="fa fa-sort-alpha-{{$order}} fa-fw"></i> &nbsp;
                                    Table
                                </a>
                            </li>
                            <li>
                                <a href="{{url('/dashboard/tables/people/' . $order)}}"> &nbsp;
                                    <i class="fa fa-sort-amount-{{$order}} fa-fw"></i> &nbsp;
                                    People
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
    </div>

@endsection