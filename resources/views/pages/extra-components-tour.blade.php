{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Tour')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/shepherd-js/shepherd-theme-default.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/extra-components-tour.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Tour start -->
<div class="section">
  <div class="card-panel">
    <a href="https://github.com/shipshapecode/shepherd" target="_blank">Shepherd</a> is a JavaScript library for guiding
    users through your app. It uses Tether, another open source library, to render dialogs for each tour "step".
    Among many things, Tether makes sure your steps never end up off screen or cropped by an overflow.
  </div>
  <div class="row">
    <div class="col s12">
      <div class="card-panel">
        <h6 class="mt-0">Tour</h6>
        <!--Tour start button -->
        <button class="btn waves-effect waves-light" id="tour">Start Tour</button>
      </div>
    </div>
  </div>
</div>
@endsection
{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/shepherd-js/shepherd.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/extra-components-tour.js')}}"></script>
@endsection