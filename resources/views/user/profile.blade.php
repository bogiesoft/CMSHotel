@extends('layouts.app')
@section('header')
    <style>
        .block{
            min-height: 100vh;
            height: auto;
        }
        .block>.container{
            padding-top: 15vh;
        }
        .tab-content {
            padding-top: 15vh;
        }

        .tabs-div{
            width: 100%;
            border-bottom: 1px #dddddd solid;
        }
    </style>
@endsection
@section('content')
    <!--  upload avatar modal  -->
    <div class="modal modal fade" tabindex="-1" role="dialog" id="uploadAvatarModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <form action="/avatar" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Choose avatar: </label>
                            <input type="file" name="img">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-link pull-right">Upload</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


<div class="block">
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <ul class="nav nav-tabs tabs-div col-md-12">
            <li>
                <a href="#reservations" data-toggle="tab">Room reservations</a>
            </li>
            <li class="active">
                <a href="#table-reservations" data-toggle="tab">Table reservations</a>
            </li>
            <li>
                <a href="#account" data-toggle="tab">Account</a>
            </li>
        </ul>
        <div id="profileTabContent" class="tab-content">
            <div class="tab-pane fade" id="account">
                @include('user.account')
            </div>
            <div class="tab-pane fade active in" id="reservations">
                @foreach($reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.reservations')
                    </div>
                @endforeach
            </div>
            <div class="tab-pane fade" id="table-reservations">
                @foreach($table_reservations as $reservation)
                    <div class="col-md-6">
                        @include('user.table-reservations')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
    <script src="{{ URL::asset('js/profile.js') }}"></script>
    <script>
        $('[data-toggle="popover"]').popover({
            container: 'body',
            content: function() {
                return $("#receipt-popover").html();
            }
        });
    </script>
@endsection