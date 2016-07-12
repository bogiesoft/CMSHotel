@extends('layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <form method="POST" action="/user/{{$user->id}}">
            {{csrf_field()}}
            {{method_field('patch')}}
            @include('admin.users.edit-create-form')
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection