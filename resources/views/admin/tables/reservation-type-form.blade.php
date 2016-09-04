<form action="/dashboard/tables/reservations/type" method="post" class="">
    {{csrf_field()}}
        <div class="form-group col-md-6">
            <input name="name" value="" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <input name="duration" type="time" step="900" value="00:15" class="form-control">
        </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-sm btn-info pull-right">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
</form>