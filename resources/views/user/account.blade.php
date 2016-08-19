<form method="POST" action="/users/{{Auth::user()->id}}" style="padding: 0 1em 1em 1em" class="form-horizontal">
    <fieldset class="fieldset">
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <legend>Change account info: </legend>

        <div class="form-group">
            <label class="col-md-2">Name: </label>
            <div class="col-md-10">
                <input type="text" name="name" class="form-control" value="@if(Auth::check()){{Auth::user()->name}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">Lastname: </label>
            <div class="col-md-10">
                <input type="text" name="lastname" class="form-control" value="@if(Auth::check()){{Auth::user()->lastname}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">E-mail: </label>
            <div class="col-md-10">
                <input type="email" name="email" class="form-control" value="@if(Auth::check()){{Auth::user()->email}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">Sex</label>
            <div class="col-md-10">
                <div class="radio">
                    <label>
                        <input type="radio" name="sex" value="0" checked>
                        Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="sex" value="1"
                        @if(Auth::check())
                            @if(Auth::user()->sex)
                                {{' checked'}}
                                    @endif
                                @endif>
                        Female
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <button type="submit" class="btn btn-default">Save changes</button>
            </div>
        </div>
    </fieldset>
</form>