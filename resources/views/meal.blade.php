<div class="media">
    <div class="media-left">
        <a src="#" title="{{$meal->meal_type->name}}">
            <img src="/images/meals/{{$meal->img}}" class="img-circle img-meals media-object">
        </a>
    </div>
    <div class="media-body">
        <p class="media-heading menu-border">
            <strong>{{$meal->name}}</strong>
            <span class="badge pull-right" >€{{$meal->price}}</span>
        </p>
        <p>{{$meal->text}}</p>
    </div>
</div>