<div class="modal fade" tabindex="-1" role="dialog" id="showRoomModal{{$room->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div style="padding: 1em">
                    @include('room')
                </div>
            </div>
        </div>
    </div>
</div>