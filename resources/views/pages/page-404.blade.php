{{-- extend Layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','404 Page')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-404.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section section-404 p-0 m-0 height-100vh">
  <div class="row">
    <!-- 404 -->
    <div class="col s12 center-align white">
      <img src="{{asset('images/gallery/error-2.png')}}" class="bg-image-404" alt="">
      <h1 class="error-code m-0">404</h1>
      <h6 class="mb-2">BAD REQUEST</h6>
      <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4"
        href="{{asset('ecommerce')}}">Back
        TO Home</a>
    </div>
  </div>
</div>
@endsection