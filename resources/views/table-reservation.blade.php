<div class="col-md-12">
    <h3 class="text-center text-info">Book a table</h3>
</div>
<div class="col-md-10 col-md-offset-1 form-div">
<form method="POST" action="/table-reservation" id="form-reservation">
    {{csrf_field()}}
    <div class="col-md-6">
        <div class="form-group">
            <label>Reservation on name: </label>
            <input type="text" name="name" class="form-control" value="@if(Auth::check()){{ Auth::user()->name . ' ' . Auth::user()->lastname}}@endif">
        </div>

        <div class="form-group">
            <label>Date: </label>
            <div class="input-group date">
                <input type="text" name="date" class="form-control">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
            </div>
        </div>

        <div class="form-group">
            <label>Time: </label>
            <input name="time" type="time" class="form-control" step="1800" value="12:00">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>People</label>
            <select name="people" class="form-control">
                @for($i=1; $i<=8 ; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Coming for: </label>
            <select name="type" class="form-control">
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            @if(\Auth::check())
                <label>&nbsp</label>
                <button type="submit" class="form-control btn btn-info submit-res">
                    <span class="glyphicon glyphicon-chevron-right"> </span>
                    <span class="glyphicon glyphicon-chevron-right"> </span>
                </button>
            @else
                <label>&nbsp</label>
                <button type="button" data-toggle="modal" data-target="#loginModal" class="form-control btn btn-link">
                    Login to book a table
                </button>
            @endif

        </div>
    </div>
</form>
</div>


