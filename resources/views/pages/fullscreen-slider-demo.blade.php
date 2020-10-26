{{-- extend layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Fullscreen Slider')

{{-- page content --}}
@section('content')
<div class="slider fullscreen">
    <ul class="slides">
        <li>
            <img src="{{asset('images/gallery/46.jpg')}}" class="responsive-img" alt="sample img">
            <!-- random image -->
            <div class="caption center-align">
                <h3 class="white-text">This is our big tagline</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
        <li>
            <img src="{{asset('images/gallery/47.jpg')}}" class="responsive-img" alt="sample img">
            <!-- random image -->
            <div class="caption left-align">
                <h3 class="white-text">Left Aligned</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
        <li>
            <img src="{{asset('images/gallery/48.jpg')}}" class="responsive-img" alt="sample img">
            <!-- random image -->
            <div class="caption right-align">
                <h3 class="white-text">Right Aligned</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
            </div>
        </li>
    </ul>
</div>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/fullscreen-slider.js')}}"></script>
@endsection