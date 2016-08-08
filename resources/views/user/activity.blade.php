<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
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
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <select name="reservation" class="form-control">
                        @foreach($reservations as $reservation)
                            <option value="{{$reservation->id}}">{{$reservation->room->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Day: </label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label>Time:  </label>
                    <input type="time" name="hour" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>