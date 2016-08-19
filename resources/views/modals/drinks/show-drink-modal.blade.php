<div class="modal fade" id="showDrinkModal{{$drink->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form action="/dashboard/drinks/{{$drink->id}}" method="post" >
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        @include('admin.drinks.show')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>