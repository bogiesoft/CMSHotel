
<div class="col-md-12">
    <a href="{{url('/receipt/'. $reservation->id)}}" target="_blank" class="label label-danger pull-right">PDF Receipt</a>
</div>
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
        <td class="text-center">€{{$reservation->room->price}}</td>
        <td class="text-center">{{floatval($reservation->people * $reservation->room->price)}}</td>
    </tr>
    <?php
    $i = 0;
    $grouped = $reservation->activities()->selectRaw('*, count(*) as count')->groupBy('activity_id')->get();
    ?>
    @foreach($grouped as $activity)
        <tr>
            <td class="text-center">{{$activity->name}}</td>
            <td class="text-center">{{$grouped[$i]->count}}</td>
            <td class="text-center">€{{$activity->price}}</td>
            <td class="text-center">€{{$activity->price}}</td>
        </tr>
        <?php $i++;
        ?>
    @endforeach
    @foreach($reservation->meals()->orderBy('name')->get() as $meal)
        <tr>
            <td class="text-center">{{$meal->name}}</td>
            <td class="text-center">{{$meal->pivot->count}}</td>
            <td class="text-center">€{{$meal->price}}</td>
            <td class="text-center">€{{floatval($meal->price * $meal->pivot->count)}}</td>
        </tr>
    @endforeach
    @foreach($reservation->drinks()->get() as $drink)
        <tr>
            <td class="text-center">{{$drink->name}}</td>
            <td class="text-center">{{$drink->pivot->count}}</td>
            <td class="text-center">€{{$drink->price}}</td>
            <td class="text-center">€{{floatval($drink->price * $drink->pivot->count)}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td><strong class="text-info">Total:</strong></td>
        <td>€{{$reservation->price}}</td>
    </tr>
</table>