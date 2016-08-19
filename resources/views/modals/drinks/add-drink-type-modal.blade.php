<div class="modal fade" id="addDrinkTypeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form id="" action="/dashboard/drink-types" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" class="form-control" name="types" placeholder="Insert values separated by a comma. E.g. Fruit, meat">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="width: 100%;">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>