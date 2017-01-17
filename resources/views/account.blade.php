@extends('layouts.app')

@section('optional_js')
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#file-input').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Acount</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if( session('edit_success') )
                    <div class="alert alert-success">
                        {{ session('edit_success') }}
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Account
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('emailupdate', $user->id) }}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                {!! method_field('PUT') !!}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <img id="file-input" src="{{ $user->image ? asset($user->image) : asset('assets/img/default.jpg') }}" class="img-responsive img-circle col-md-4" alt="your image" />
                                        <input type="file" name="image" id="imgInp" class="inputfile col-md-8" />
                                    </div>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Password
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('passwordupdate', $user->id) }}">
                                {!! csrf_field() !!}
                                {!! method_field('PUT') !!}
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input class="form-control" type="password" name="old_password" value="">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input class="form-control" type="password" name="password" value="">
                                </div>
                                <div class="form-group">
                                    <label>Re-Type New Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" value="">
                                </div>

                                <input class="btn btn-primary" type="submit" value="Simpan">

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection