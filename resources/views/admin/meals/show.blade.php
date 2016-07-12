<img src="/images/meals/{{$meal->img}}" alt="{{$meal->name}} photo" class="img-responsive img-rounded center-block">
<hr>
<h4 class="text-center">{{$meal->name}}</h4>
<p class="text-justify">{{$meal->text}}</p>
<ul class="list-group">
    <li class="list-group-item">
        <i class="fa fa-apple" aria-hidden="true"></i>&nbsp;
       Meal type: {{$meal->meal_type->name}}
    </li>
    <li class="list-group-item">
        <i class="fa fa-eur" aria-hidden="true"></i>&nbsp;
        Price (in euros): {{$meal->price}}
    </li>
</ul>


