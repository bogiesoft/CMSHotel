<div class="row">
    @foreach($drinks as $drink)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="media">
                <div class="media-body" >
                    <h4>{{$drink->name}}<span class="badge pull-right">${{$drink->price}}</span> </h4>
                    <p>{{$drink->text}}</p>
                    <span class="label label-danger">{{$drink->drink_type->name}}</span>
                </div>
            </div>
        </div>
    @endforeach

</div>
