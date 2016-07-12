<div class="form-group">
    <label>Name: </label>
    <input type="text" name="name" value="@if(isset($meal)){{$meal->name}}@endif" class="form-control">
</div>
<div class="form-group">
    <label>Meal type: </label>
    <select name="meal_type" class="form-control">
        @foreach($types as $type)
            <option
                @if(isset($meal) && $meal->meal_type_id == $type->id) {{ ' selected' }}@endif value="{{$type->id}}">
                    {{$type->name}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Price (in euros): </label>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-money fw" aria-hidden="true"></i>
        </span>
        <input type="number" step="0.1" name="price" value="@if(isset($meal)){{$meal->price}}@else  {{1.00}} @endif" class="form-control">
    </div>
</div>

<div class="form-group">
    <label>Meal description: </label>
    <textarea name="text" class="form-control">@if(isset($meal)){{$meal->text}}@endif</textarea>
</div>

<div class="form-group">
    <label>Choose a photo: </label>
    <input type="file" name="img" class="form-control">
</div>