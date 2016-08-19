<div class="modal fade" tabindex="-1" role="dialog" id="showActivityModal{{$activity->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center">{{$activity->name}}</h4>
                <div style="padding: 1em">
                @include('user.activity')
                </div>
            </div>
        </div>
    </div>
</div>