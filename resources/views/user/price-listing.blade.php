<table class="table">
    <thead>
        <th>Detail</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
    </thead>
    <tr>
        <td class="text-center">{{$reservation->room->name}}</td>
        <td class="text-center">{{$reservation->people}}</td>
        <td class="text-center">{{$reservation->room->price}}</td>
        <td class="text-center">{{floatval($reservation->people * $reservation->room->price)}}</td>
    </tr>
    @foreach($reservation->activities()->get() as $activity)
        <tr>
            <td class="text-center">{{$activity->name}}</td>
            <td class="text-center">1</td>
            <td class="text-center">{{$activity->price}}</td>
            <td class="text-center">{{$activity->price}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td><strong class="text-info">Total (in euros):</strong></td>
        <td>{{$reservation->price}}</td>
    </tr>
</table>