@extends('layouts.index')
@section('content')


<div class="container bootstrap snippets bootdey">
    <div class="row ng-scope">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <br>
                    <br>
                    <br>
                    <p>Name: {{ $data->first_name . ' ' . $data->last_name }}</p>
                    <p>Email: {{ $data->email }}</p>

                    <br>
                    <br>
                    <br>
                    <div class="text-center">
                        @if (Session::has('loginId') && $data->role === 'admin')
                        <a class="btn btn-danger" href="{{ route('admin.dashboard') }}">Go to admin panel</a>
                        @endif
                        <a class="btn btn-danger" href="{{ route('logout') }}">Sign out</a>
                    </div>
                    <br>
                    <br>
                </div>
                <div class="text-center">
                    <form action="@">
                        <div class="row ng-scope">
                            <label class="col-sm-2 control-label" for="upload_cv">Upload CV</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="upload_cv" name="upload_cv" type="file">
                            </div>
                        </div>
                    </form>
                    <form action="{{ route('index') }}" method="GET">
                        <p>OR</p>
                        <p>Make a new one:</p>
                        <button class="btn btn-primary">New CV</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <br>
                    <br>
                    <br>
                    <div class="h4 text-center">Contact Information</div>
                    <div class="row pv-lg">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form class="form-horizontal ng-pristine ng-valid" action="{{ route('profilePost') }}" method="POST">
                                @method('POST')
                                @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif
                                @if(Session::has('fail'))
                                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="first_name">First Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->first_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="middle_name">Mid Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="middle_name" name="middle_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->middle_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="last_name">Last Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->last_name : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="email" name="email" type="text" placeholder="" value="{{ Session::has('loginId') ? $data->email : '' }}">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-info" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
