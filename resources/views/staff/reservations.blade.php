@extends('layouts.dashboard')
@section('content')
<?php $active = 'reservations';  ?>

<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading">
    <h5 class="panel-title">
        <i class="fa fa-calendar" style="vertical-align: middle"></i>&nbsp;
        Today's hotel check-ins
    </h5>
</div>
<div class="panel-body">
<table class="table table-hover table-responsive">
    <thead>
    <th>#</th>
    <th>Name</th>
    <th>Arrival</th>
    <th>Departure</th>
    <th>People</th>
    <th>Check-in</th>
    </thead>
    @foreach($todays as $reservation)
        <tr id="reservation{{$reservation->id}}">

            <td>{{$reservation->id}}</td>
            <td>{{$reservation->name}}</td>
            <td>{{$reservation->getFormattedArrivalDate()}}</td>
            <td>{{$reservation->getFormattedDepartureDate()}}</td>
            <td>{{$reservation->people}}</td>
            <td>
                <form action="/dashboard/reservations/{{$reservation->id}}/check-in" method="post">
                    {{csrf_field()}}
                    <button
                            type="submit"
                            class="btn-check btn btn-sm @if($reservation->checked_in) {{'btn-success'}} @else {{'btn-default'}} @endif"
                            data-token="{{csrf_token()}}"
                            data-type = "reservations"
                            value="{{$reservation->id}}">
                        <i class="fa fa-check" aria-hidden="false" aria-label="delete"></i>&nbsp;
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    <tfoot>
        <td colspan="6" class="text-center">{{$todays->links()}}</td>
    </tfoot>
</table>
</div>
</div>
</div>

@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection