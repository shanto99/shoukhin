@extends('master')
@section('title')
    Registration Page
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/Signup.css') }}">
 @endsection
@section('maincontent')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

        <div class="stepwizard col-md-offset-3">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>

        <form role="form" action="{{ route('do_registration') }}" method="post" enctype="multipart/form-data">
            <div class="row setup-content" id="step-1">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3>Please fill up the following Information</h3>
                        <div class="form-group">
                            <label class="control-label">
                                Name
                            </label>
                            <input maxlength="100" type="text" name="name" required="required" class="form-control" placeholder="Enter Your Name or Company Name" />

                        </div>
                        <div class="form-group">
                            <label class="control-label">

                                E-mail
                            </label>
                            <input maxlength="100" type="text" name="email" required="required" class="form-control" placeholder="Provide a valid e-mail" />

                        </div>
                        <div class="form-group">
                            <label class="control-label">

                                Password
                            </label>
                            <input maxlength="100" type="password" name="password" required="required" class="form-control" placeholder="Max 8 Charecters" />

                        </div>
                        <div class="form-group">
                            <label class="control-label">

                                Confirm Password
                            </label>
                            <input maxlength="100" type="password" name="confirm_password" required="required" class="form-control" />

                        </div>

                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-2">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3> Upload a Profile Photo</h3>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" name="image_field" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br>
                        <br>
                        <img id='img-upload' />
                        <br />
                        I am a Professional <input type="checkbox" name = is_pro value="1">
                        <br />
                        <br>

                        <button class="btn btn-link prevBtn btn-success pull-left" type="button">Previous</button>
                        <button class="btn btn-link nextBtn btn-success pull-right" type="button">Next</button>
                    </div>
                </div>
            </div>
            <div class="row setup-content" id="step-3">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3> Please Select at least One categories you are interested in </h3>
                        <div class="row">
                            <div class="form-group">
                                <div class="searchable-container">
                                    <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                                        <div class="info-block block-info clearfix">

                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="1">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>Pets</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                                        <div class="info-block block-info clearfix">

                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="2">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>Plants</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <button class="btn btn-link prevBtn btn-success pull-left" type="button">Previous</button>
                        <button class="btn btn-link nextBtn btn-success pull-right" type="submit">Submit</button>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('script')
    <script src="{{ url('src/js/Signup.js') }}"></script>
    <script src="{{ url('src/js/SignupPage2.js') }}"></script>
@endsection