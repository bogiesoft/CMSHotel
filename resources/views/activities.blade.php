@extends('layouts.app')
@section('content')
    <div class="block">
        <div class="container">
        <?php   $delay = 0; ?>
        @foreach($activities as $activity)
                <div class="col-sm-6 col-md-4 hide-opacity bounceInLeft"
                     style="
                             -webkit-animation-delay: {{$delay}}s;
                             -moz-animation-delay: {{$delay}}s;
                             -o-animation-delay: {{$delay}}s;
                             animation-delay: {{$delay}}s;">
                    <div class="thumbnail">
                        <img src="/images/activities/{{$activity->img}}" class="img-responsive img-rounded">
                        <div class="caption">
                            <h4 class="list-group-item-heading">
                                {{$activity->name}}
                                <p class="badge pull-right">€{{$activity->price}}</p>
                            </h4>
                            <p class="list-group-item-text equal-height">
                            {{$activity->text}}
                            <p class="">Duration: {{$activity->getFormattedDuration()}}</p>

                            </p>
                        </div>
                    </div>
                </div>
            <?php $delay += 0.5  ?>
            @endforeach
            <div class="col-md-12 text-center center-block">
                {{$activities->links()}}
            </div>
                <div class="col-md-12 text-center">
                    <h4 class="text-info">
                        <small>You can enjoy these activities while staying at our hotel </small>
                    </h4><hr>
                </div>
        </div>
    </div>
@endsection