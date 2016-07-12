@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height:100vh;
            height: auto;
        }
        .block>.container{
            padding-top: 25vh;
        }
    </style>
@endsection
@section('content')
<div class="block">
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <form role="form" method="POST" action="{{ url('/password/email') }}">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label">E-Mail Address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-btn fa-envelope-o"></i> Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
