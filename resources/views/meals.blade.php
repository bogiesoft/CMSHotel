<div class="row">
    <div class="col-md-12">
        <h3 class="text-center text-info">MEALS</h3><hr>
    </div>
    @foreach($meals as $meal)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading">
                        {{$meal->name}}
                        <span class="badge">${{$meal->price}}</span>
                    </h4>
                    <p>{{$meal->text}}</p>
                </div>
                <div class="media-right">
                    <a src="#">
                        <img src="/images/meals/{{$meal->img}}" class="img-circle img-meals media-object">
                    </a>
                </div>
            </div>
        </div>
    @endforeach

</div>