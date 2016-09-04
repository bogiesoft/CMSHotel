<div class="modal fade" tabindex="-1" role="dialog" id="addReservationTypeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="text-center">Add a new table reservation type</h4>
                <div class="row">
                   @include('admin.tables.reservation-type-form')
                </div>
            </div>
        </div>
    </div>
</div>