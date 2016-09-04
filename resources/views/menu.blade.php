@extends('layouts.app')
@section('content')


    <div class="loading-div" hidden><i class="fa fa-cog fa-3x fa-spin fa-fw loading"></i></div>
    <div class="fog" hidden></div>

<div class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-info text-center text-uppercase">Meals</h4><hr>
            </div>
        </div>
        <form action="/meal-order" method="post" id="meal-order-form">
            {{csrf_field()}}
            <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
            <?php  $i = 0; ?>
            <div class="row">
                @foreach($meals as $meal)
                    <?php  $i++; ?>
                    <div class="col-md-6">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            @include('meal')
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4" style="padding-bottom: 2em">
                            <div class="form-group col-xs-10 col-sm-8 col-md-8">
                                <input type="number" name="meals_count[{{$meal->id}}]" value="1"  step="1"class="form-control">
                            </div>
                            <div class="form-group col-xs-2 col-sm-4 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="meals_checked[]" value="{{$meal->id}}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($i % 2 == 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-info text-center text-uppercase">Drinks</h4><hr>
                </div>
            </div>
            <div class="row">
                <?php  $i = 0; ?>
                @foreach($drinks as $drink)
                    <?php  $i++; ?>
                    <div class="col-md-4">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            @include('drink')
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6" style="padding-bottom: 2em">
                            <div class="form-group col-xs-10 col-sm-8 col-md-8">
                                <input type="number" name="drinks_count[{{$drink->id}}]" value="1"  step="1"class="form-control">
                            </div>
                            <div class="form-group col-xs-2 col-sm-4 col-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="drinks_checked[]" value="{{$drink->id}}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($i % 3 == 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach <hr>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success success-res" hidden>
                        <p class="text-center"></p>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 10vh">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <button value="{{$reservation->id}}" class="btn btn-info btn-block submit-order" data-token = "{{csrf_token()}}" title="Finish order">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer')
    <script src="{{ URL::asset('js/menu.js') }}"></script>
@endsection