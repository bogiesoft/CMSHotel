
<div class="modal fade" tabindex="-1" role="dialog" id="past-reservations">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br><br>

                <div class="row-fluid">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <i class="fa fa-shopping-cart"></i>&nbsp;
                                Yesterday's in room orders
                            </h5>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-responsive">
                                <thead>
                                <th>Activity</th>
                                <th>Date</th>
                                <th>Charged to room</th>
                                <th>Name</th>
                                </thead>
                                @foreach($activities as $activity)

                                    @foreach(
                                        $activity->reservations()->where([
                                            ['time', '<',$now],
                                            ['time', '>=', $now->copy()->subDays(1)]
                                            ])->get()
                                        as $order)

                                        <tr id="order{{$order->pivot->id}}">
                                            <td>{{$activity->name}}</td>
                                            <td>{{(new \Carbon\Carbon($order->pivot->time))->toDayDateTimeString()}}</td>
                                            <td>{{$order->room->name}}</td>
                                            <td>{{$order->name}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
