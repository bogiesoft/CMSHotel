@extends('layouts.app')
@section('content')

    <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
    <div class="fog" hidden></div>

<div class="block">
    <div class="container">
        <div class="col-md-12">
            <div class="alert alert-success success-res" hidden>
                <p class="text-center"></p>
            </div>
        </div>
        <div class="col-md-12">
            <h3 class="text-center text-uppercase text-info">Menu</h3><hr>
        </div>
        <form action="/meal-order" method="post" id="meal-order-form">
            {{csrf_field()}}
            <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
            <?php  $i = 0; ?>
            @foreach($meals as $meal)
                @if($i % 2 == 0)
                    <div class="row">
                @endif
                <?php  $i++; ?>
                    <div class="col-md-6">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            @include('meal')
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4" style="padding-bottom: 2em">
                            <div class="form-group col-xs-10 col-sm-8 col-md-8">
                                <select class="form-control" name="count[{{$meal->id}}]">
                                    @for($num = 1; $num <= $max_count ; $num++)
                                        <option value="{{$num}}">{{$num}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-xs-2 col-sm-4 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="checked[]" value="{{$meal->id}}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($i % 2 == 0)
                        </div>
                    @endif
            @endforeach
            @if($i % 2 != 0)
                </div>
            @endif


            <div class="row">
                <div class="form-group col-md-6 col-md-offset-6">
                    <button value="{{$reservation->id}}" class="btn btn-info btn-block submit-order" data-token = {{csrf_token()}}>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/menu.js') }}"></script>
@endsection