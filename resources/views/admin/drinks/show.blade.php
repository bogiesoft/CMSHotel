<!--
<img src="/images/meals/{{$drink->img}}" alt="{{$drink->name}} photo" class="img-responsive img-rounded center-block">
<hr>
-->
<h4 class="text-center">{{$drink->name}}</h4>
<ul class="list-group">
    <li class="list-group-item">
        {{$drink->text}}
    </li>
    <li class="list-group-item">
        <i class="fa fa-glass" aria-hidden="true"></i>&nbsp;
        Drink type: {{$drink->drink_type->name}}
    </li>
    <li class="list-group-item">
        <i class="fa fa-eur" aria-hidden="true"></i>&nbsp;
        Price (in euros): {{$drink->price}}
    </li>
</ul>


