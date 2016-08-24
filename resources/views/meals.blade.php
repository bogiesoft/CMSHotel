<div class="row-fluid">
        <?php  $i = 0; ?>
    @foreach($meals as $meal)
        <?php  $i++; ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 meal-div">
            @include('meal')
        </div>
        @if($i % 3 == 0)
            <div class="clearfix"></div>
        @endif
    @endforeach
</div>