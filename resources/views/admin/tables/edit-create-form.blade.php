<div class="form-group">
    <label>Name: </label>
    <input type="text" name="name" value="@if(isset($table)){{$table->name}}@endif" class="form-control">
</div>

<div class="form-group">
    <label>Maximum people: </label>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-users fw" aria-hidden="true"></i>
        </span>
        <input type="number" step="1" name="people" value="@if(isset($table)){{$table->people}}@else{{4}}@endif" class="form-control">
    </div>
</div>

