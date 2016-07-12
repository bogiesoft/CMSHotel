@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <table class="table table-striped">
           <thead>
               <th>#</th>
               <th>Room</th>
               <th>Arrival</th>
               <th>Last day</th>
               <th>Checked-in</th>
           </thead>
            <?php  $i=0 ?>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$reservation->room->name}}</td>
                <td>{{$reservation->arrival}}</td>
                <td>{{$reservation->departure}}</td>
                <td>
                    <label>
                        <!--
                        <input type="checkbox" value="true" @if($reservation->checked_in)  {{' checked'}} @endif>
                         -->
                    </label>
                </td>
            </tr>
            @endforeach

        </table>
    </div>
@endsection