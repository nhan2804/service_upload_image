@extends('welcome')
@section('title','404 File Not Found')
@section('content')
    <br><br>
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Oops! File not found.</h1>
            <h2><a href="{{ url('/') }}"><span style="text-decoration: underline;">Try Here!</span> Back Home.</a></h2>
        </div>
    </div>
    <br><br>
        <div style="margin: 0;">
            <img src="{{asset('public/images/404.png')}}" alt="404 Image" style="width: 700px;display: block;margin: 0 auto">
        </div>
@endsection