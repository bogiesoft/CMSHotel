<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12" style="margin-bottom: 2em">
            <img src="/images/activities/{{$activity->img}}" class="img-responsive img-rounded center-block">
            <h4 class="text-center">{{$activity->name}}</h4>
            <p>{{$activity->text}}</p>
            <h6>
                <span class="pull-left">
                    <span class="glyphicon glyphicon-time"></span>
                    {{$activity->getFormattedDuration()}}</span>
                <span class="pull-right">
                    <span class="fa fa-money"></span>
                    {{$activity->price}}</span>
            </h6>
        </div>
        @if(isset($reservation))
        <div class="col-md-12">
            <form action="/activity-orders" method="POST">
                {{csrf_field()}}

                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                    <input type="hidden" name="departure" value="{{$reservation->departure}}">
                    <input type="hidden" name="activity_id" value="{{$activity->id}}">

                <div class="form-group">
                    <label>Day: </label>
                    <div class="input-group date">
                        <input type="text" name="date" class="form-control">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Time:  </label>
                    <input type="time" name="time" class="form-control" step="1800" value="09:00">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
