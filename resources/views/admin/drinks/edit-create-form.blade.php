<div class="form-group">
    <label>Name: </label>
    <input type="text" name="name" value="@if(isset($drink)){{$drink->name}}@endif" class="form-control">
</div>
<div class="form-group">
    <label>Drink type: </label>
    <select name="drink_type" class="form-control">
        @foreach($types as $type)
            <option
                    @if(isset($drink) && $drink->drink_type->id == $type->id) {{ ' selected' }}@endif value="{{$type->id}}">
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
        <input type="number" step="0.1" name="price" value="@if(isset($drink)){{$drink->price}}@else  {{1.00}} @endif" class="form-control">
    </div>
</div>

<div class="form-group">
    <label>Drink description: </label>
    <textarea name="text" class="form-control">@if(isset($drink)){{$drink->text}}@endif</textarea>
</div>

<!--

<div class="form-group">
    <label>Choose a photo: </label>
    <input type="file" name="img" id="img-input" class="form-control">
</div>

-->
