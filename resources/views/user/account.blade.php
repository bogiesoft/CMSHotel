@include('modals.upload-avatar-modal')
<div class="col-md-4">
    <a href="#" data-toggle="modal" data-target="#uploadAvatarModal">
        <img src="/images/users/avatars/{{\Auth::user()->img}}" class="img-responsive img-circle">
    </a>
</div>
<div class="col-md-8">
    <form method="POST" action="/users/{{Auth::user()->id}}" style="padding: 0 1em 1em 1em" class="form-horizontal">
        <fieldset class="fieldset">
            <legend>Change account info: </legend>
            {{csrf_field()}}
            {{method_field('PATCH')}}

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
    <form method="POST" action="/users/{{Auth::user()->id}}" style="padding: 0 1em 1em 1em" class="form-horizontal">
        <fieldset>
            <legend>Change password: </legend>
            {{csrf_field()}}
            {{method_field('PATCH')}}

            <div class="form-group">
                <label class="col-md-2">Old password: </label>
                <div class="col-md-10">
                    <input type="password" name="old" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">New password: </label>
                <div class="col-md-10">
                    <input type="password" name="new" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <button type="submit" class="btn btn-default" name="password">Change password</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>