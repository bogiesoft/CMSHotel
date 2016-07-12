@extends('layouts.app')
@section('header')
<style>

    .block{
        min-height: 100vh;
        height: auto;
    }

    .block.bg-image{
        background-image: url('/images/web/home02.jpg');
        background-color: rgba(0,0,0, .5);
        background-size: cover;
        position: relative;
    }

    .block>.container{
        padding-top: 25vh;
    }

    .home-text{
        color: white;
    }

</style>
@endsection
@section('content')
        <div class="block bg-image">
            <div class="container">
                    <h2 class="text-info text-center"><strong>Curabitur turpis sapien</strong></h2>
                    <p class="home-text text-center h6">Maecenas blandit felis nec massa porta, sed laoreet nunc blandit.</p>
                    <form action="/rooms" method="get">
                        <button class="btn btn-lg btn-info center-block" type="submit">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            Browse rooms
                        </button>
                    </form>
            </div>
        </div>

@endsection
