<div class="form-group">
    <label>Name: </label>
    <input name="name" class="form-control" value="@if(isset($activity))    {{$activity->name}}    @endif" required>
</div>
<div class="form-group">
    <label>Description: </label>
    <textarea name="text" class="form-control" required>@if(isset($activity)){{$activity->text}}@endif</textarea>
</div>
<div class="form-group">
    <label>Price: </label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-money"></i>
        </div>
        <input name="price" type="number" step="0.1" class="form-control" value="@if(isset($activity)){{$activity->price}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label>Photo: </label>
    <input name="img" type="file" class="form-control">
</div>
<div class="form-group">
    <label>Duration: </label>
    <input name="duration" type="time" class="form-control" step="900"  value="@if(isset($activity)){{$activity->duration}}@else{{'00:15'}}@endif" required>
</div>
