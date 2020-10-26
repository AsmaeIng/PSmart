{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add User')
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 30px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.User')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	


<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.NewUser')</h4>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="input-field col m4 s12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="input-field col m4 s12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="input-field col m4 s12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="input-field col m4 s12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="input-field col m4 s12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple', 'name' => 'roles')) !!}
        </div>
    </div>
	<div class="col m4 s12 input-field">
		<input id="username" name="username" type="text" class="validate" >
		<label for="username">@lang('locale.Name')</label>
	</div>
</div>
<div class="row">
	<div class="col m4 s12 input-field">
		<input id="tel" name="tel" type="text" class="validate" >
		<label for="tel">Phone</label>
	</div>
	<div class="col m4 s12 input-field">
		<input class="validate" type="text" id="cin" name="cin" >
		<label>N° CIN</label>
	</div>
	<div class="col m4 s12 input-field">
		<input class="validate" id="cnss" name="cnss" type="text" >
		<label>N° CNSS</label>
	</div>
</div>
<div class="row">
	
	<!--<div class="col m4 s12">
		<label for="languageselect2">Languages</label>
            <div class="input-field">
                <select class="browser-default" id="languageselect2" name="laguage[]" multiple="multiple" size="80">									
					<option value="Arabic" >@lang('locale.Arabic')</option>
					<option value="French"  >@lang('locale.French')</option>
					<option value="English" >@lang('locale.English')</option>			
					<option value="Spanish"  >@lang('locale.Spanish')</option>							
					<option value="German"  >@lang('locale.German')</option>							
					<option value="Russian"  >@lang('locale.Russian')</option>								
					<option value="Italy" >@lang('locale.Italy')</option>
				</select>                                 
			</div>
	</div>-->
	<div class="input-field col m4 s6">
		<select id="city_id" name="city_id">
			@foreach($cities as $citie)							
				<option id="{{ $citie->id }}" value="{{ $citie->id }}">{{ $citie->city }}</option>
			@endforeach
		</select>
		<label for="PremierPaiement">@lang('locale.Ville')</label>
	</div>
	<div class="input-field col m4 s12">
		<input id="street" type="text" name="street" >
		<label for="dress">@lang('locale.Adress')</label>
	</div>
</div>
<div class="row">
	<div class="col m4 s12 input-field">
		<select id="verified" name="verified">
			<option value="YES">YES</option>
			<option value="NO">NO</option>
		</select>
		<label>@lang('locale.Verified')</label>
					  
	</div>
    <div class="col m4 s12 input-field">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
 </div>
     
	 </div>
	 </div>
    </div>
</div>

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/page-users.js')}}"></script>
<script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
@endsection