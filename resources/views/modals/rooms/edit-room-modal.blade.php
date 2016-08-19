<div class="modal fade" tabindex="-1" role="dialog" id="editRoomModal{{$room->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div style="padding: 1em">
                    <form action="/dashboard/rooms/{{$room->id}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        @include('admin.rooms.edit-create-form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="width: 100%">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>