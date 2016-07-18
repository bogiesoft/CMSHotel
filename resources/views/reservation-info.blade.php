<div class="col-sm-12 col-md-10 col-md-offset-1">
    <?php
     $reservation = \Auth::user()->reservations()->orderBy('created_at', 'descending')->first();
    ?>
    <h3>Reservation info</h3>
    <p>Room: {{$reservation->room->name}}</p>
    <p>Arrival: {{$reservation->arrival}}</p>
    <p>Departure: {{$reservation->departure}}</p>
    <a href="{{url('/reservation')}}" class="btn btn-link">Back</a>
    <a href="{{url('/profile')}}" class="btn btn-link">Profile</a>
</div>