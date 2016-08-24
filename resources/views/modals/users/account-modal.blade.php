<?php $user = \Auth::user()  ?>
<div class="modal fade" tabindex="-1" id="accountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-capitalize text-center"></h4>
            </div>
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form action="/dashboard/users/{{$user->id}}" method="POST" style="padding: 1em">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="form-group">
                        <label>Name: </label>
                        <input name="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label>Last name: </label>
                        <input name="lastname" class="form-control" value="{{$user->lastname}}">
                    </div>
                    <div class="form-group">
                        <label>Sex: </label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="sex" value="0" checked>
                                Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="sex" value="1" @if($user->sex){{' checked' }}@endif>
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="input-group">
                            <?php   $email = explode('@', $user->email)    ?>
                            <input name="email" type="text" class="form-control" value="{{$email[0]}}">
                            <span class="input-group-addon">{{'@'}}cmshotel.com</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>New password: </label>
                        <input name="new_password" type="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Old password: </label>
                        <input name="old_password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><i class="fa fa-pencil" title="Edit"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>