@extends('layouts.dashboard')
@section('content')

@include('modals.activities.add-activity-modal')
<?php $active = 'activities';  ?>
<div class="col-sm-12 col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5 class="panel-title">
                <i class="fa fa-shopping-cart"></i>&nbsp;
                Activities
                <a class="btn btn-xs btn-info pull-right"
                   data-toggle="modal"
                   data-target="#addActivityModal">
                    <i class="fa fa-plus"></i>&nbsp; add
                </a>
            </h5>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-responsive">
                <thead>
                <th class="hidden-xs hidden-sm"></th>
                <th>Name</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Text</th>
                <th>Options</th>
                </thead>

                @foreach($activities as $activity)
                    <tr id="activity{{$activity->id}}" @if($activity->trashed()) class="text-muted" title="This activity is not available for reservations"    @endif>
                        <td class="hidden-xs hidden-sm" style="width: 5%;"><img src="/images/activities/{{$activity->img}}" class="img-circle" style="width: 100%"> </td>
                        <td>{{$activity->name}}</td>
                        <td>{{$activity->duration}}</td>
                        <td>{{$activity->price}}</td>
                        <td>{{substr($activity->text, 0, 50) . '...'}}</td>
                        <td>
                            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#showActivityModal{{$activity->id}}">
                                <i class="fa fa-eye fa-fw" aria-hidden="false" aria-label="show"></i>
                            </button>
                            <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#editActivityModal{{$activity->id}}">
                                <i class="fa fa-pencil-square-o fa-fw" aria-hidden="false" aria-label="edit"></i>
                            </button>
                            @if($activity->trashed())
                                <button type="submit" class="btn btn-sm btn-info restore-activity" data-token="{{csrf_token()}}" value="{{$activity->id}}" title="Make activity available for reservation">
                                    <i class="fa fa-cart-plus fa-fw" aria-hidden="false"></i>
                                </button>
                            @else
                                <button type="submit" class="btn btn-sm btn-info delete-activity" data-token="{{csrf_token()}}" value="{{$activity->id}}">
                                    <i class="fa fa-trash fa-fw" aria-hidden="false" aria-label="delete"></i>
                                </button>
                            @endif

                        </td>
                    </tr>
                    @include('modals.activities.show-activity-modal')
                    @include('modals.activities.edit-activity-modal')
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>
@endsection