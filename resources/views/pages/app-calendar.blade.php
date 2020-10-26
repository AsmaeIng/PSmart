{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Calendar')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/fullcalendar/css/fullcalendar.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/fullcalendar/daygrid/daygrid.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/fullcalendar/timegrid/timegrid.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-calendar.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Full Calendar -->
<div id="app-calendar">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">
            Basic Calendar
          </h4>
          <div id="basic-calendar"></div>
        </div>
      </div>
    </div>
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">
            External Dragging
          </h4>
          <div class="row">
            <div class="col m3 s12">
              <div id='external-events'>
                <h5>Draggable Events</h5>
                <div class="fc-events-container mb-5">
                  <div class='fc-event' data-color='#009688'>All Day Event</div>
                  <div class='fc-event' data-color='#4CAF50'>Long Event</div>
                  <div class='fc-event' data-color='#00bcd4'>Meeting</div>
                  <div class='fc-event' data-color='#ff5722'>Birthday party</div>
                  <div class='fc-event' data-color='#9c27b0'>Lunch</div>
                  <div class='fc-event' data-color='#e51c23'>Conference Meeting</div>
                  <div class='fc-event' data-color='#e91e63'>Party</div>
                  <div class='fc-event' data-color='#3f51b5'>Happy Hour</div>
                  <div class='fc-event' data-color='#ffc107'>Dance party</div>
                  <div class='fc-event' data-color='#4a148c'>Dinner</div>
                  <p>
                    <label>
                      <input type="checkbox" id="drop-remove" />
                      <span>Remove After Drop</span>
                    </label>
                  </p>
                </div>
              </div>
            </div>
            <div class="col m9 s12">
              <div id='fc-external-drag'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{--vendor scripts  --}}
@section('vendor-script')
<script src="{{asset('vendors/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('vendors/fullcalendar/daygrid/daygrid.min.js')}}"></script>
<script src="{{asset('vendors/fullcalendar/timegrid/timegrid.min.js')}}"></script>
<script src="{{asset('vendors/fullcalendar/interaction/interaction.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-calendar.js')}}"></script>
@endsection