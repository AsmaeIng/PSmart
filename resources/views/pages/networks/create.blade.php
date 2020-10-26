{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Network')
{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
@endsection

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Networks')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.AddNewNetworks')</h4>
			<form method="POST" action="{{ route('networks.store') }}" enctype="multipart/form-data" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="name" type="text" name="name" >
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m3 s6">
						<input id="login" type="text" name="login" >
						<label for="login">@lang('locale.login')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="password" type="text" name="password">
						<label for="password">@lang('locale.password')</label>
					</div>
					<div class="col s3 file-field input-field">									
							
								  <div class="waves-effect waves-light btn-small">
									<span>Logo <i class="material-icons right">cloud</i></span>
									<input type="file" name="image" accept="image/*">
								  </div>
								  <div class="file-path-wrapper">
									<input class="file-path validate" id="image" name="image" type="text" placeholder="Upload one or more files">
								  </div>
								
								@if ($errors->has('files'))
									@foreach ($errors->get('files') as $error)
									<span class="invalid-feedback" role="alert">
										<strong>{{ $error }}</strong>
									</span>
									@endforeach
								  @endif				
					</div>
				</div>	
				<div class="row">
					<div class="input-field col m3 s6"> 
						<input id="URLSignIn" type="text" name="URLSignIn">
						<label for="URLSignIn">@lang('locale.URLSignIn')</label>
					</div>
					<div class="input-field col m3 s6">
						<input id="AffiliateID" type="text" name="AffiliateID">
						<label for="AffiliateID">@lang('locale.AffiliateID')</label>
					</div>
					<div class="input-field col m3 s6">
						<input id="APIAccessKey" type="text" name="APIAccessKey" >
						<label for="APIAccessKey">@lang('locale.APIAccessKey')</label>
					</div>
					<div class="input-field col m3 s6">
						<input id="APIHostURL" type="text" name="APIHostURL" >
						<label for="APIHostURL">@lang('locale.APIHostURL')</label>
					</div>
				</div> 
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="token" type="text" name="token" >
						<label for="token">Token</label>
					</div>
					<div class="input-field col m3 s6">
						<select id="plateform_id" name="plateform_id">
							@foreach($plateform as $plat)							
								<option id="{{ $plat->id }}" value="{{ $plat->id }}">{{ $plat->name }}</option>
							@endforeach
							</select>
						<label for="PlateformSponsor">@lang('locale.PlateformSponsor')</label>
					</div>			  
					<div class="input-field col m3 s6">
						 <label>
							<input id="type" name="type" type="checkbox" checked="checked" />
							<span>@lang('locale.IsActive')</span>
						  </label>
					</div>					
					<div class="input-field col m3 s6">
					
					</div>										
				</div> 
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action" href="{{ route('networks.index') }}"> @lang('locale.Retour')
							<i class="material-icons right">keyboard_return</i>
						</a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection