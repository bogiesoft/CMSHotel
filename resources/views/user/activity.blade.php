<div class="row">
    <div class="col-md-2">
        <img src="/images/activities/{{$activity->img}}" class="img-responsive img-circle">
    </div>
    <div class="col-md-10">
        <h4 class="list-group-item-heading">
            {{$activity->name}}
            <p class="badge pull-right">€{{$activity->price}}</p>
        </h4>
        <p class="list-group-item-text">
            {{$activity->text}}
        <p class="">Duration: {{$activity->getFormattedDuration()}}</p>

        </p>
    </div>
</div>
