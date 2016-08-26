<div class="modal modal fade" tabindex="-1" role="dialog" id="uploadAvatarModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div style="padding: 1em;">
                    <form action="users/{{\Auth::user()->id}}/avatar" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Choose avatar: </label>
                            <input type="file" name="img">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-default">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>