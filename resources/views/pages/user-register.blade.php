{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','User Register')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/register.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="register-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
    <form class="login-form"method="POST" action="{{ route('register') }}">
      @csrf
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Register</h5>
          <p class="ml-4">Join to our community now !</p>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="name" type="text">
          <label for="name" class="center-align">Username</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">mail_outline</i>
          <input id="email" type="email">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password-again" type="password">
          <label for="password-again">Password again</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <a href="{{asset('/')}}"
            class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Register</a>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <p class="margin medium-small"><a href="{{asset('user-login')}}">Already have an account? Login</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection