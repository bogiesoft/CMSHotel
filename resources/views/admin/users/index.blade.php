@extends('layouts.dashboard')
@section('header')
    <style>
        .btn-label{
            border:none;
            padding-top:4px;
            padding-bottom:4px;
            font-weight: bold;
            line-height: 1;
            font-size:75%
        }
    </style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="pull-right">
            <a href="/user/create/staff">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-plus"></span>
                    <span class="glyphicon glyphicon-user"></span>
                    Staff
                </button>
            </a>
        </div>
    </div>
    <div class="row">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>E-mail</th>
            <th>Role</th>
            <th></th>
        </thead>
        <?php  $i=0;  ?>
        @foreach($users as $user)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->role}}</td>
            <td>
                <form role="form" action="/user/{{$user->id}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <a href="/user/{{$user->id}}/edit"><span class="label label-default">edit</span></a>
                    <button type="submit" class="label label-danger btn-label">delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </table>
    </div>
</div>
@endsection