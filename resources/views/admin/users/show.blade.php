@extends('layouts.dashboard')
@section('content')

    <div class="col-md-12">
        <form class="form-horizontal" action="/user{{$user->id}}/update" method="POST">
            {!!   csrf_field() !!}
            {!! method_field('patch') !!}
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" value="{{$user->name }}">
            </div>

            <div class="form-group">
                <label>Lastname</label>
                <input class="form-control" type="text" value="{{$user->lastname }}">
            </div>

            <div class="form-group">
                <label>email</label>
                <input class="form-control" type="text" value="{{$user->email }}">
            </div>

            <div class="form-group">
                <label>Current role: <span class="text-capitalize text-danger">{{ $user->role->role }}</span></label><br>
                <label>Change role: </label>
                @foreach($roles as $role)
                <div class="radio">
                    <label class="text-capitalize">
                        <input type="radio" name="role" value="{{$role->id}}" @if($role == $user->role) {{' checked'}}  @endif>
                        {{$role->role}}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">Save changes</button>
            </div>
        </form>
    </div>
@endsection