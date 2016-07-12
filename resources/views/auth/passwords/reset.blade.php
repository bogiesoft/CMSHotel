@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height:100vh;
            height: auto;
        }
        .block>.container{
            padding-top: 15vh;
        }
    </style>
@endsection
@section('content')
<div class="block">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <form role="form" method="POST" action="{{ url('/password/reset') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label">E-Mail Address</label>
                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="password">
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
                        <i class="fa fa-btn fa-refresh"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
