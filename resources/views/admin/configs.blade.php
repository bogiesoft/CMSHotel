@extends('layouts.dashboard')
@section('content')
<?php $active = 'configs';  ?>
<div class="col-md-12">
   <div class="panel panel-default">
       <div class="panel-heading">
           <h5 class="panel-title">
               <i class="fa fa-wrench"></i> &nbsp;
               Configuration variables</h5>
       </div>
       <div class="panel-body">
               <table class="table table-hover table-responsive">
                   <thead>
                   <th>Name</th>
                   <th>Value</th>
                   <th>Description</th>
                   <th>Options</th>
                   </thead>
                   @foreach($configs as $config)
                   <tr>
                       <form id="config-form{{$config->id}}" action="/dashboard/configs/{{$config->id}}" method="post">
                           {{method_field('patch')}}
                           {{csrf_field()}}
                           <td>
                               <p>{{$config->config}}</p>
                           </td>
                           <td>
                               <input name="value" value="{{$config->value}}" class="form-control input-sm" required>
                           </td>
                           <td>
                               <p>{{$config->description}}</p>
                           </td>
                           <td>
                               <button value="{{$config->id}}" type="submit" class="update-config btn btn-xs btn-default">
                                   update
                               </button>
                           </td>
                       </form>
                   </tr>
                   @endforeach
               </table>

       </div>
   </div>
</div>

@endsection