<div style="padding:0 5vw 5vw 5vw">
    <form id="loginForm" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="role" value="guest">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">E-Mail Address</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">
                <i class="fa fa-btn fa-sign-in"></i>Login
            </button>
        </div>
    </form>
</div>

@section('validation')

@endsection