<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" value="@if(isset($user)) {{$user->name}} @endif" class="form-control">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname: </label>
        <input type="text"  id="lastname" name="lastname" value="@if(isset($user)) {{$user->lastname}} @endif" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">E-mail: </label>
            <input type="email"  id="email" name="email" value="@if(isset($user)) {{$user->email}} @endif" class="form-control">

    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="role">Role: </label>
        <select name="role" id="role" class="form-control text-capitalize">
            @foreach($roles as $role)
                <option class="text-capitalize" value="{{$role->id}}"
                @if(isset($user))
                    @if($user->role->id == $role->id)
                        {{ ' selected' }}
                            @endif
                        @endif>
                    {{$role->role}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="sex">Sex: </label>
        <select name="sex" class="form-control">
            <option value="0">Male</option>
            <option value="1"
            @if(isset($user))
                @if($user->sex == '1')
                    {{ ' selected' }}
                        @endif
                    @endif>Female</option>
        </select>
    </div>
</div>