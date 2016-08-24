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

    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                    Table reservations
                </h5>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>Table</th>
                        <th>People</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Rating</th>
                        </thead>
                        @foreach($tables as $table)
                            <tr>
                                <td colspan="5" class="text-info">{{$table->name}}</td>
                            </tr>
                            @foreach($table->reservations()->get() as $reservation)
                                <tr>
                                    <td></td>
                                    <td>{{$reservation->people}}</td>
                                    <td>{{$reservation->getFormattedArrivalDate()}}</td>
                                    <td>{{$reservation->name}}</td>
                                    <td>
                                        @if($reservation->rating != 0)
                                            @for($i=1; $i <=$reservation->rating; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        @else
                                            {{'NR'}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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