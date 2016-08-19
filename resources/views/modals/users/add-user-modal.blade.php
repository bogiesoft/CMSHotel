<div class="modal fade" tabindex="-1" id="addUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title text-capitalize text-center"></h4>
            </div>
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <form action="/dashboard/users" method="POST" style="padding: 1em">
                    {{csrf_field()}}
                    <input type="hidden" name="role" value="" class="role">
                    <div class="form-group">
                        <label>Name: </label>
                        <input name="name" class="form-control" placeholder="Jane">
                    </div>
                    <div class="form-group">
                        <label>Last name: </label>
                        <input name="lastname" class="form-control" placeholder="Doe">
                    </div>
                    <div class="form-group">
                        <label>Sex: </label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="sex" value="0">
                                Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="sex" value="1" checked>
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="input-group">
                            <input name="email" type="text" class="form-control" placeholder="janedoe">
                            <span class="input-group-addon">{{'@'}}cmshotel.com</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password: </label>
                        <input name="password" type="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Confirm password: </label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>