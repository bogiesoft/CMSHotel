<div class="media">
    <div class="media-left">
        <a src="#" title="{{$meal->meal_type->name}}">
            <img src="/images/meals/{{$meal->img}}" class="img-circle img-meals media-object">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading">
            {{$meal->name}}
            <span class="badge pull-right">€{{$meal->price}}</span>
        </h4>
        <p>{{$meal->text}}</p>
    </div>
</div>