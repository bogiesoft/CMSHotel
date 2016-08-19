<div class="modal fade" id="showMealModal{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form action="/dashboard/meals/{{$meal->id}}" method="post" >
                        {{csrf_field()}}
                        {{method_field('patch')}}
                        @include('admin.meals.show')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>