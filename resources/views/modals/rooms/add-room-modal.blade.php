<div class="modal fade" tabindex="-1" role="dialog" id="addRoomModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center">Add a new room</h4>
                <div style="padding: 1em">
                    <form action="/dashboard/rooms" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('admin.rooms.edit-create-form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="width: 100%">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>