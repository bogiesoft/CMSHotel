<div class="row">
    <h3 class="text-center text-info">MEALS</h3><hr>
</div>
<div class="row-fluid">
    <?php  $i = 0; ?>
    @foreach($meals as $meal)
    @if($i % 3 == 0)
    <div class="row">
    @endif
    <?php  $i++; ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 meal-div">
            <div class="media">
                <div class="media-left">
                    <a src="#">
                        <img src="/images/meals/{{$meal->img}}" class="img-circle img-meals media-object">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{$meal->name}}
                        <span class="badge">${{$meal->price}}</span>
                    </h4>
                    <p>{{$meal->text}}</p>
                </div>
            </div>
        </div>
    @if($i % 3 == 0)
    </div>
    @endif
    @endforeach

    @if($i % 3 != 0)
        </div>
    @endif
</div>