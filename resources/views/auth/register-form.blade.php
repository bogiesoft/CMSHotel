<div style="padding:0 5vw 5vw 5vw">
    <form role="form" method="POST" action="{{ url('/register') }}" id="registrationForm">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label class="control-label">Lastname</label>
            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
        </div>

        <div class="form-group">
            <label class="control-label">Sex: </label>
        </div>
        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" name="sex" value="0" checked>
                Male
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" value="1">
                Female
            </label>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">E-Mail Address</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" >

            @if ($errors->has('email'))
                <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" name="password" minlength="6">
            @if ($errors->has('password'))
                <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif

        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="control-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">
                <i class="fa fa-btn fa-user"></i> Register
            </button>
        </div>
    </form>
</div>