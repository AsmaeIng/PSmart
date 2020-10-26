{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Account Settings')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Account settings -->
<section class="tabs-vertical mt-1 section">

  <div class="row">
  <form action="/userUpdate/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
		  @method('PUT')
    <div class="col l4 s12">
      <!-- tabs  -->
      <div class="card-panel">
        <ul class="tabs">
          <li class="tab">
            <a href="#general">
              <i class="material-icons">brightness_low</i>
              <span>General</span>
            </a>
          </li>
          <li class="tab">
            <a href="#change-password">
              <i class="material-icons">lock_open</i>
              <span>Change Password</span>
            </a>
          </li>
          <li class="tab">
            <a href="#info">
              <i class="material-icons">error_outline</i>
              <span> Info</span>
            </a>
          </li>
          <li class="tab">
            <a href="#social-link">
              <i class="material-icons">chat_bubble_outline</i>
              <span>Info Personnel</span>
            </a>
          </li>
          <!--<li class="tab">
            <a href="#connections">
              <i class="material-icons">link</i>
              <span>Connections</span>
            </a>
          </li>-->
          <li class="tab">
            <a href="#notifications">
              <i class="material-icons">notifications_none</i>
              <span> Notifications</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
	
    <div class="col l8 s12">
	
	  <!-- tabs content -->
      <div id="general">
        <div class="card-panel">
          <div class="display-flex">
			<div class="media">
            @foreach($images as $log)	
					@if (@$user->id===$log->user_id)
						<a class="mr-2" name="path" href="/{{$log->path}}">			
						  <img src="/{{$log->path}}" alt="{{$log->name}}" class="z-depth-4 circle" height="64" width="64">				
						</a>
					@endif
				@endforeach
            </div>			
            <div class="media-body">
              <div class="general-action-btn">
				<div class="file-field input-field">
					<div class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2">
						<span>Images <i class="material-icons right">cloud</i></span>
						<input type="file" name="files[]" multiple accept="image/*">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" id="photo" name="photo" type="text" placeholder="Upload one or more files">
					</div>
				</div>
              </div>
              <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
              <div class="upfilewrapper">
                <input id="photo" name="photo" type="file" />
              </div>
            </div>
          </div>
		  
          <div class="divider mb-1 mt-1"></div>
          <form class="formValidate" >
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <label for="name">@lang('locale.Username')</label>
                  <input type="text" id="name" name="name" value="{{ $user->name }}" data-error=".errorTxt1">
                  <small class="errorTxt1"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="username">@lang('locale.name')</label>
                  <input id="username" name="username" type="text" value="{{ $user->username }}" data-error=".errorTxt2">
                  <small class="errorTxt2"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="email">E-mail</label>
                  <input id="email" type="email" name="email" value="{{ $user->email }}" data-error=".errorTxt3">
                  <small class="errorTxt3"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="card-alert card orange lighten-5">
                  <div class="card-content orange-text">
                    <p>Your email is not confirmed. Please check your inbox.</p>
                    <a href="javascript: void(0);">Resend confirmation</a>
                  </div>
                  <button type="button" class="close orange-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="tel" name="tel" value="{{ $user->tel }}" type="text">
                  <label for="tel">@lang('locale.Phone')</label>
                </div>
              </div>
			 
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2" name="action">Save
                  changes</button>
                <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="change-password">
        <div class="card-panel">
          <form class="paaswordvalidate">
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input id="oldpswd" name="oldpswd" value="{{ $user->password }}" type="password" data-error=".errorTxt7">
                  <label for="oldpswd">Old Password</label>				  
                  <small class="errorTxt4"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="password" name="password" type="password" data-error=".errorTxt8">
                  <label for="password">New Password</label>
                  <small class="errorTxt5"></small>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="repswd" type="password" name="repswd" data-error=".errorTxt9">
                  <label for="repswd">Retype new Password</label>
                  <small class="errorTxt6"></small>
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2" name="action">Save changes</button>
                <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="info">
        <div class="card-panel">
          <form class="infovalidate">
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input type="text"  class="birthdate-picker datepicker" id="accountTextarea" name="accountTextarea" 
				  value = "<?php $dateNaissance = $user->birthDate; $aujourdhui = date("Y-m-d");  $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
						echo ' '.$diff->format('%y'); ?>" >
                  <label for="accountTextarea">Age</label>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="birthDate" name="birthDate" value="{{ $user->birthDate }}" type="text" class="birthdate-picker datepicker">
                  <label for="birthDate">Birth date</label>
                </div>
              </div>
              <div class="col s12">
                <label for="languageselect2">Languages</label>
                <div class="input-field">
                  <select class="browser-default" id="languageselect2" name="laguage[]" multiple="multiple" size="80">
                   @if(strpos($user->laguage, 'Arabic') !== false)
							<option value="Arabic" selected >@lang('locale.Arabic')</option>
							@else
							<option value="Arabic" >@lang('locale.Arabic')</option>
							@endif
							@if(strpos($user->laguage, 'French') !== false)					
							<option  value="French" selected >@lang('locale.French')</option>
							@else
							<option value="French"  >@lang('locale.French')</option>
							@endif
							@if(strpos($user->laguage, 'English') !== false)
							<option value="English"  selected >@lang('locale.English')</option>
							@else
							<option value="English" >@lang('locale.English')</option>
							@endif
							@if(strpos($user->laguage, 'Spanish') !== false)
							<option value="Spanish" selected >@lang('locale.Spanish')</option>
							@else
							<option value="Spanish"  >@lang('locale.Spanish')</option>
							@endif
							@if(strpos($user->laguage, 'German') !== false)
							<option value="German"  selected >@lang('locale.German')</option>
							@else
							<option value="German"  >@lang('locale.German')</option>
							@endif
							@if(strpos($user->laguage, 'Russian') !== false)
							<option value="Russian"  selected >@lang('locale.Russian')</option>
							@else
							<option value="Russian"  >@lang('locale.Russian')</option>
							@endif
							@if(strpos($user->laguage, 'Itali') !== false)
							<option value="Italy"  selected >@lang('locale.Italy')</option>
							@else
							<option value="Italy" >@lang('locale.Italy')</option>
							@endif
					</select>
                </div>
              </div>             

                  <div class="col s12 input-field">
                  
					<select id="city_id" name="city_id">
						@foreach($data1 as $country)							
							<option id="{{ $country->idCountry }}" value="{{ $country->idCountry }}" select>{{ $country->nameCont }}</option>
						@endforeach
						@foreach($countrys as $country)							
							<option id="{{ $country->id }}" value="{{ $country->id }}">{{ $country->name }}</option>
						@endforeach
					</select>
					<label for="country">@lang('locale.Pays')</label>
								                    
                  </div>
                  @foreach($data1 as $adr)
                  <div class="col s12 input-field">
						<input id="street" name="street" type="text" value="{{ $adr->street }}" class="validate" data-error=".errorTxt5">
						<label for="address">@lang('locale.Adress')</label>
						<small class="errorTxt5"></small>
                  </div>
				  @endforeach
				  <div class="col s12 input-field">
                    <select id="city_id" name="city_id">
						@foreach($data1 as $citie)							
						<option id="{{ $citie->idCities }}" value="{{ $citie->idCities }}" select>{{ $citie->city }}</option>
						@endforeach
						@foreach($cities as $citie)							
						<option id="{{ $citie->id }}" value="{{ $citie->id }}">{{ $citie->city }}</option>
						@endforeach
					</select>
					<label for="PremierPaiement">@lang('locale.Ville')</label>
                  </div> 
				
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2" name="action">Save
                  changes</button>
                <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
              </div>
            
          </form>
        </div>
      </div>
      <div id="social-link">
        <div class="card-panel">
          <form>
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input class="validate" type="text" id="cin" name="cin" value="{{ $user->cin }}">
                  <label for="twitter-link">N° CIN</label>
                </div>
              </div>              
              <div class="col s12">
                <div class="input-field">
                  <input class="validate" id="cnss" name="cnss" type="text" value="{{ $user->cnss }}">
                    <label>N° CNSS</label>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="tel" name="tel" type="text" class="validate" value="{{ $user->tel }}">
                    <label for="tel">Phone</label>
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="skype" name="skype" type="text" class="validate" value="{{ $user->skype }}">
				  <label for="skype">Skype</label>
                </div>
              </div>

              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2" name="action">Save
                  changes</button>
                <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
     <!-- <div id="connections">
        <div class="card-panel">
          <div class="row">
            <div class="col s12 mt-1 mb-1">
              <a href="javascript: void(0);" class="btn cyan waves-effect waves-light">
                Connect to <strong>Twitter</strong>
              </a>
            </div>
            <div class="col s12 mt-1 mb-1">
              <button class="btn btn-small waves-effect waves-light btn-light-indigo float-right">edit</button>
              <h6>You are connected to facebook.</h6>
              <p>Johndoe@gmail.com</p>
            </div>
            <div class="col s12 mt-1 mb-1">
              <a href="javascript: void(0);" class="btn waves-effect waves-light">Connect to
                <strong>Google</strong>
              </a>
            </div>
            <div class="col s12 mt-1 mb-1">
              <button class="btn btn-small btn-light-indigo float-right waves-effect waves-light">edit</button>
              <h6>You are connected to Instagram.</h6>
              <p>Johndoe@gmail.com</p>
            </div>
            <div class="col s12 display-flex justify-content-end form-action">
              <button type="submit" class="btn indigo waves-effect waves-light mr-2">Save
                changes</button>
              <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
            </div>
          </div>
        </div>
      </div>-->
      <div id="notifications">
        <div class="card-panel">
          <div class="row">
            <h6 class="col s12 mb-2">Activity</h6>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" checked id="accountSwitch1">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">@lang('locale.EmailStaf')</span>
              </div>
            </div>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" checked id="accountSwitch2">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">
                  Email me when someone answers on my form</span>
              </div>
            </div>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" id="accountSwitch3">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">
                  Email me hen someone follows me</span>
              </div>
            </div>
            <h6 class="col s12 mb-2 mt-2">Application</h6>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" checked id="accountSwitch4">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">News and announcements</span>
              </div>
            </div>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" id="accountSwitch5">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">Weekly product updates</span>
              </div>
            </div>
            <div class="col s12 mb-1">
              <div class="switch">
                <label>
                  <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                  <span class="lever"></span>
                </label>
                <span class="switch-label w-100">Weekly blog digest</span>
              </div>
            </div>
			
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2" name="action">Save
                  changes</button>
                <a type="button" class="btn btn-light" name="action" href="{{asset('page-users-list')}}">Cancel</a>
              </div>
          </div>
        </div>
      </div>    
	</div>
	</form>
  </div>
  
</section>
@endsection

{{-- page scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
@endsection