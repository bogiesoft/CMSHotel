<div class="modal fade" tabindex="-1" role="dialog" id="showUserModal{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row" style="padding: 1em">
                    <div class="col-md-6">
                        <img src="/images/users/avatars/{{$user->img}}" alt="{{$user->name}} avatar" class="img-responsive img-circle center-block">
                    </div>
                    <div class="col-md-6" class="text-center">
                        <h5>{{$user->name . ' ' . $user->lastname}}</h5>
                        <h5>{{$user->email}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>