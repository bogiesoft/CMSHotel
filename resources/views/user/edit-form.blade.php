<form method="POST" action="/user/{{Auth::user()->id}}" style="padding: 0 1em 1em 1em">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
        <label>Name: </label>
        <input type="text" name="name" class="form-control" value="@if(Auth::check()){{Auth::user()->name}}@endif">
    </div>

    <div class="form-group">
        <label>Lastname: </label>
        <input type="text" name="lastname" class="form-control" value="@if(Auth::check()){{Auth::user()->lastname}}@endif">
    </div>

    <div class="form-group">
        <label>E-mail: </label>
        <input type="email" name="email" class="form-control" value="@if(Auth::check()){{Auth::user()->email}}@endif">
    </div>

    <div class="form-group">
        &nbsp;<label class="radio-inline">
            <input type="radio" name="sex" value="0" checked>
            Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="sex" value="1"
            @if(Auth::check())
                @if(Auth::user()->sex)
                    {{' checked'}}
                @endif
            @endif>
            Female
        </label>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-info">Save changes</button>
    </div>
</form>