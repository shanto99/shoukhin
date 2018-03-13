@extends('master')
@section('title')
    Log In page
@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('src/css/login.css') }}">
@endsection
@section('maincontent')

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

    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" action="{{ route('do_login') }}">
                <input type="text" placeholder="E-mail" name="email"/>
                <input type="password" placeholder="password" name="password"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button>login</button>
                <p class="message">Not registered? <a href="{{ route('route_registration') }}">Create an account</a></p>
            </form>
            <a class="btn btn-success" href="{{ $login_url  }}">Log In with Facebook</a>
        </div>
    </div>
@endsection