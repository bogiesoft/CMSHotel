<img src="/images/rooms/{{$room->img}}" alt="{{$room->name}} photo" class="img-responsive img-rounded center-block">
<hr>
<h4 class="text-center">{{$room->name}}</h4>
<p class="text-justify">{{$room->text}}</p>
<ul class="list-group">
    <li class="list-group-item">
        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
        Maximum people allowed: {{$room->max_people}}
    </li>
    <li class="list-group-item">
        <i class="fa fa-paw" aria-hidden="true"></i>&nbsp;
        Pets allowed:@if($room->pets){{'Yes'}}@else{{'No'}} @endif
    </li>
    <li class="list-group-item">
        <i class="fa fa-wifi" aria-hidden="true"></i>&nbsp;
        Wi-fi:@if($room->wifi){{'Yes'}}@else{{'No'}} @endif
    </li>
    <li class="list-group-item">
        <i class="fa fa-spoon" aria-hidden="true"></i>&nbsp;
        Kitchen:@if($room->kitchen){{'Yes'}}@else{{'No'}} @endif
    </li>
    <li class="list-group-item">
        <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
        Balcony:@if($room->balcony){{'Yes'}}@else{{'No'}} @endif
    </li>
    <li class="list-group-item">
        <i class="fa fa-arrows-alt" aria-hidden="true"></i>&nbsp;
        Room size: {{$room->size}}
    </li>
    <li class="list-group-item">
        <i class="fa fa-eur" aria-hidden="true"></i>&nbsp;
        Price (in euros): {{$room->price}}
    </li>
</ul>