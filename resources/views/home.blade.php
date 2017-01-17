@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            Twitter Apps
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="{{ route('tweet') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input class="form-control" type="text" value="{{ old('status') }}" name="status" placeholder="Update Status...">
                                        </div>
                                        <input type="submit" value="Update" class="btn btn-info pull-right">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                @foreach($tweets as $tweet)
                                    <div class="col-lg-12">
                                        <div class="{{ ($tweet->user_id == Auth::user()->id)? 'well text-right':'well-white text-left' }}">
                                            <div class="row">
                                                <div class="col-md-2 {{ ($tweet->user_id == Auth::user()->id)? 'pull-right':'pull-left' }}">
                                                    <img src="{{ $tweet->user->image ? asset($tweet->user->image) : asset('assets/img/default.jpg') }}" class="img-circle img-responsive" style="width:100px; height:100px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <h4>{{ $tweet->user->name }}</h4>
                                                    <p>{{ $tweet->tweet }}</p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection
