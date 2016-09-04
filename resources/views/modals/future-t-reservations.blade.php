<div class="modal fade" tabindex="-1" role="dialog" id="future-reservations">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br><br>

                <div class="row-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <i class="fa fa-calendar" style="vertical-align: middle"></i>&nbsp;
                                Tomorrow's restaurant check-ins
                            </h5>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-responsive">
                                <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Arrival</th>
                                <th>People</th>
                                <th>Check-in</th>
                                </thead>
                                @foreach($tomorrow as $reservation)
                                    <tr id="reservation{{$reservation->id}}">
                                        <td>{{$reservation->id}}</td>
                                        <td>{{$reservation->name}}</td>
                                        <td>{{$reservation->getFormattedArrivalDate()}}</td>
                                        <td>{{$reservation->people}}</td>
                                        <td>
                                            <button class="btn btn-sm @if($reservation->checked_in) {{'btn-success'}} @else {{'btn-default'}} @endif">
                                                <i class="fa fa-check" aria-hidden="false" aria-label="delete"></i>&nbsp;
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
