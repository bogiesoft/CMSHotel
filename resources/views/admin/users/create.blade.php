@extends('layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <form method="POST" action="/user">
            {{csrf_field()}}
            @include('admin.users.edit-create-form')
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
@endsection