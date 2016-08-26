<div class="modal fade" id="typeErrorModal{{$type->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form id="" action="/dashboard/drink-types/{{$type->id}}" method="post">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <div class="form-group">
                            <p class="text-center">
                                Some drinks are of type: {{$type->name}}.<br>
                                Choose a different type for these drinks or cancel.
                            </p>
                            <select class="form-control text-capitalize" name="new_type">
                                @foreach($types as $other)
                                    <option value="{{$other->id}}">{{$other->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="clear_drinks" class="btn btn-info">Change</button>
                            <button type="button" data-dismiss="modal" aria-label="Cancel" class="btn btn-default">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>