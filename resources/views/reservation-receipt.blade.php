<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt for reservation {{$reservation->id}}</title>
    <!-- Styles -->
    <style>

        html {
            font-family: sans-serif;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        body {
            margin: 0;
        }
        .container {
            margin-right: auto;
            margin-left: auto;
            padding-left: 15px;
            padding-right: 15px;
        }
        .row {
            margin-left: -15px;
            margin-right: -15px;
        }
        .col-md-12{
            position: relative;
            min-height: 1px;
            padding-left: 15px;
            padding-right: 15px;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        td,
        th {
            padding: 0;
        }
        .table {
            border-collapse: collapse !important;
        }
        .table td,
        .table th {
            background-color: #fff !important;
        }
        small {
            font-size: 80%;
        }.table {
             width: 100%;
             max-width: 100%;
             margin-bottom: 23px;
         }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 8px;
            line-height: 1.846;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #dddddd;
        }
        .text-center{
            text-align: center;
        }
        .page-break {
             page-break-after: always;
         }
    </style>
</head>
<body id="app-layout">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>CMSHotel<br>
            <small>{{\Carbon\Carbon::now('Europe/Zagreb')->toDayDateTimeString()}}</small>
            </h1><hr>
        </div>
        <div class="col-md-12">
            <h3>Account Information</h3>
            <p>Name: {{$user->name}}</p>
            <p>Lastname: {{$user->lastname}}</p>
            <p>E-mail: {{$user->email}}</p><hr>
        </div>
        <div class="col-md-12">
            <h3>Reservation N°{{$reservation->id}}, check-in name: {{$reservation->name}}<br>
                <small>Booked: {{$reservation->getFormattedCreatedDate()}}</small><br>
                <small>Arrival: {{$reservation->getFormattedArrivalDate()}}</small><br>
                <small>Departure: {{$reservation->getFormattedDepartureDate()}}</small>
            </h3>

            <h4>Receipt: </h4>
            <table class="table text-center">
                <tr>
                    <td colspan="5"><strong>Room name: {{$reservation->room->name}} </strong></td>
                </tr>
                <tr>
                    <th>Day</th>
                    <th>People</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                <?php  $total = 0; ?>
                @foreach($dates as $date)
                    <tr>
                        <td>{{substr($date->toDayDateTimeString(), 0, -9)}}</td>
                        <td>{{$reservation->people}}</td>
                        <td>€{{$dayPrice = $reservation->room->priceForThisDay($date)}}</td>
                        <td>€{{$dayPrice * $reservation->people}}</td>
                    </tr>
                    <?php $total += $dayPrice * $reservation->people;  ?>
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td><strong>€{{$reservation->generatePriceForRoom()}}</strong></td>
                </tr>
            </table>
            @if(!$activities->isEmpty())
                <?php $pagebreak = 0;  ?>
                <div class="page-break"></div>
                <table class="table text-center">
                    <tr>
                        <td colspan="3"><strong>Hotel activity orders</strong></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Price</th>
                    </tr>
                    <?php  $total2 = 0; ?>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{(new \Carbon\Carbon($activity->pivot->time))->toDayDateTimeString()}}</td>
                            <td>{{$activity->name}}</td>
                            <td>€{{$activity->price}}</td>
                        </tr>
                        <?php  $total2 += $activity->price; ?>
                    @endforeach
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>€{{$reservation->generatePriceForActivities()}}</strong></td>
                    </tr>
                </table>
            @endif
            @if(!$meals->isEmpty() && !$drinks->isEmpty())
                @if(!isset($pagebreak))
                    <div class="page-break"></div>
                @endif
                <table class="table text-center">
                    <tr>
                        <td colspan="4"><strong>Food and drink orders</strong></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    <?php  $total3 = 0; ?>
                    @foreach($meals as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->pivot->count}}</td>
                            <td>€{{$order->price}}</td>
                            <td>€{{$order->price * $order->pivot->count}}</td>
                        </tr>
                        <?php  $total3 += $order->price; ?>
                    @endforeach
                    @foreach($drinks as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->pivot->count}}</td>
                            <td>€{{$order->price}}</td>
                            <td>€{{$order->price * $order->pivot->count}}</td>
                        </tr>
                        <?php  $total3 += $order->price; ?>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td><strong>€{{$reservation->generatePriceForFoodOrders() +$reservation->generatePriceForDrinkOrders()}}</strong></td>
                    </tr>
                </table>
            @endif
        </div>
        <div class="col-md-12">
           <hr> <h5>Total: €{{
           $reservation->generatePriceForRoom() +
           $reservation->generatePriceForActivities() +
           $reservation->generatePriceForFoodOrders() +
           $reservation->generatePriceForDrinkOrders()
           }}<br>
                <small>Billing name: {{$user->name . ' ' . $user->lastname}}</small>
            </h5>
            <p>Thank you for staying with us</p>
        </div>
    </div>
</div>
</body>
</html>
