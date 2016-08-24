@extends('layouts.app')
@section('content')
    <div class="block">
        <div class="container">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="/activity-orders">Active reservations</a></li>
                        <li><a href="/activity-orders/{{$reservation->id}}">Options</a></li>
                        <li class="active">Date and time</li>
                    </ol>
                </div>
                <div class="">
                    <form action="/activity-orders" method="POST">
                        {{csrf_field()}}

                        <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                        <input type="hidden" name="departure" value="{{$reservation->departure}}">
                        <input type="hidden" name="activity_id" value="{{$activity->id}}">
                        <div class="form-group col-md-6">
                            <label>Day: </label>
                            <div class="input-group date">
                                <input type="text" name="date" class="form-control">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Time:  </label>
                            <input type="time" name="time" class="form-control" step="1800" value="09:00">
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-info btn-block">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/activity-orders.js') }}"></script>
@endsection