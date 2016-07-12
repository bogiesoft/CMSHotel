<div class="form-group">
    <label for="name">Name: </label>
    <input id="name" class="form-control" type="text" name="name" value="@if(isset($room)){{ $room->name }}@endif">
</div>

<div class="form-group">
    <label for="people">Maximum people: </label>
    <input type="number" name="people" value="@if(isset($room)){{$room->max_people}}@else{{1}}@endif" class="form-control" id="people">
</div>

<div class="form-group">
    <label for="pets">Pets allowed: </label>
    <select id="pets" name="pets" class="form-control">
        <option value="0"
        @if(isset($room) && $room->pets)
            {{ ' selected' }}
                @endif>
            No
        </option>
        <option value="1"
        @if(isset($room) && $room->pets)
            {{ ' selected' }}
                @endif>
            Yes
        </option>
    </select>
</div>

<div class="form-group">
    <label for="wifi">Has Wi-Fi: </label>
    <select id="wifi" name="wifi" class="form-control">
        <option value="0"
        @if(isset($room) && $room->wifi)
            {{ ' selected' }}
                @endif>
            No
        </option>
        <option value="1"
        @if(isset($room) && $room->wifi)
            {{ ' selected' }}
                @endif>
            Yes
        </option>
    </select>
</div>

<div class="form-group">
    <label for="kitchen">Has kitchen: </label>
    <select id="kitchen" name="kitchen" class="form-control">
        <option value="0"
        @if(isset($room) && $room->kitchen)
            {{ ' selected' }}
                @endif>
            No
        </option>
        <option value="1"
        @if(isset($room) && $room->kitchen)
            {{ ' selected' }}
                @endif>
            Yes
        </option>
    </select>
</div>

<div class="form-group">
    <label for="balcony">Has balcony: </label>
    <select id="balcony" name="balcony" class="form-control">
        <option value="0"
        @if(isset($room) && $room->balcony)
            {{ ' selected' }}
                @endif>
            No
        </option>
        <option value="1"
        @if(isset($room) && $room->balcony)
            {{ ' selected' }}
                @endif>
            Yes
        </option>
    </select>
</div>

<div class="form-group">
    <label for="price">Price for one person per day (in euros): </label>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-money fw" aria-hidden="true"></i>
        </span>
        <input id="price" type="number" step="0.1" name="price" value="@if(isset($room)){{ $room->price }}@else{{10.0}}@endif" class="form-control" >
    </div>
</div>
<div class="form-group">
    <label for="size">Size: </label>
    <div class="input-group">
                    <span class="input-group-addon">
                        <span class=" glyphicon glyphicon-resize-full"></span>
                    </span>
        <input id="size" type="number" step="1" name="size" value="@if(isset($room)){{ $room->size }}@else{{15.0}}@endif" class="form-control">
        <span class="input-group-addon">m <sup>2</sup></span>
    </div>
</div>

<div class="form-group">
    <label for="room-text">Room description: </label>
    <textarea name="text" class="form-control" style="height: auto;">@if(isset($room)){{ $room->text }}@endif</textarea>
</div>

<div class="form-group">
    <label>Photo: </label>
    <input type="file" name="img" class="form-control">
</div>



