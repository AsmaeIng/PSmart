{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users edit')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
	<form action="/userUpdate/{{ $user->id }}" method="POST" enctype="multipart/form-data">
	  @csrf
	 @method('PUT')
	  <div class="card">
		<div class="card-content">
		  <!-- <div class="card-body"> -->
		  <ul class="tabs mb-2 row">
			<li class="tab">
			  <a class="display-flex align-items-center active" id="account-tab" href="#account">
				<i class="material-icons mr-1">person_outline</i><span>Account</span>
			  </a>
			</li>
			<li class="tab">
			  <a class="display-flex align-items-center" id="information-tab" href="#information">
				<i class="material-icons mr-2">error_outline</i><span>Information</span>
			  </a>
			</li>
		  </ul>
		  <div class="divider mb-3"></div>
		  <div class="row">
			<div class="col s12" id="account">
			  <!-- users edit media object start -->
			  <div class="media display-flex align-items-center mb-2">
				@foreach($images as $log)	
					@if (@$user->id===$log->user_id)
						<a class="mr-2" name="path" href="/{{$log->path}}">			
						  <img src="/{{$log->path}}" alt="{{$log->name}}" class="z-depth-4 circle" height="64" width="64">				
						</a>
					@endif
				@endforeach
				<div class="media-body">
				  <h5 class="media-heading mt-0">{{ $user->username }}</h5>
				   <div class="form-group">
					  <input type="file" name="files[]" multiple class="form-control" accept="image/*">
				  </div>
				</div>
			  </div>
			  <!-- users edit media object ends -->
			  <!-- users edit account form start -->
			  <form id="accountForm" >
				
				<div class="row">
				  <div class="col s12 m6">
					<div class="row">
					  <div class="col s12 input-field">
						<input id="name" name="name" type="text" class="validate" value="{{ $user->name }}" data-error=".errorTxt1">
						<label for="name">@lang('locale.Username')</label>
						<small class="errorTxt1"></small>
					  </div>
					  <div class="col s12 input-field">
						<input id="username" name="username" type="text" class="validate" value="{{ $user->username }}"  data-error=".errorTxt2">
						<label for="username">@lang('locale.Name')</label>
						<small class="errorTxt2"></small>
					  </div>
					  <div class="col s12 input-field">
						<input id="email" name="email" type="email" class="validate" value="{{ $user->email }}" data-error=".errorTxt3">
						<label for="email">E-mail</label>
						<small class="errorTxt3"></small>
					  </div>
					</div>
				  </div>
				  <div class="col s12 m6">
					<div class="row">
						<div class="col s12 input-field">
							<div class="form-group">
								<strong>Role:</strong>
								{!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
							</div>
						</div>
						<div class="col s12 input-field">
							@if(Cache::has('is_online' . $user->id))
								<input id="Status" name="Status" type="text"  value="Online" class="validate green-text">
							@else
								<input id="Status" name="Status" type="text"  value="Offline" class="validate red-text">
							@endif
						<label>Status</label>
						</div>
						<div class="col s12 input-field">

							<select id="verified" name="verified">
								<option value="{{ $user->verified }}" selected>{{ $user->verified }}</option>
								<option value="YES">YES</option>
								<option value="NO">NO</option>
							</select>
							<label>@lang('locale.Verified')</label>					  
						</div>
					</div>
				  </div>
				  <!--<div class="col s12">
					<table class="mt-1">
					  <thead>
						<tr>
						  <tr>	
					<th>Module Permission</th>
					@foreach ($permissions as $perm)
					<th>{{ $perm->name}}</th>
					@endforeach
				  </tr>
					  </thead>
					  <tbody>                
						@foreach ($group as $gro)
						<tr>			  
							<td >{{ $gro->name}}</td>
							<td>
								<label>
								  <input type="checkbox" checked />
								  <span></span>
								</label>
							</td>
							<td>
								<label>
								  <input type="checkbox" checked />
								  <span></span>
								</label>
							</td>
							<td>
								<label>
								  <input type="checkbox" checked />
								  <span></span>
								</label>
							</td>
							<td>
								<label>
								  <input type="checkbox"  />
								  <span></span>
								</label>
							</td>
						</tr>
						@endforeach
						 
						</tr>
					  </tbody>
					</table>
					<!-- </div> -->
				  <!--</div>-->
				  <div class="col s12 display-flex justify-content-end mt-3">
					<button type="submit" class="btn indigo">
					  Save changes</button>
					<button  class="btn btn-light"name="action" ><a href="{{ route('isps.index') }}"></a> Cancel</button>
				  </div>
				</div>
			  
			  <!-- users edit account form ends -->
			</div>
			<div class="col s12" id="information">
			  <!-- users edit Info form start -->
			  <form id="infotabForm">
				<div class="row">
				  <div class="col s12 m6">

					<div class="col s12">
						<h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
					</div>
					<div class="col s12 input-field">
						<input class="validate" type="text" id="cin" name="cin" value="{{ $user->cin }}">
						<label>N° CIN</label>
					</div>
					<div class="col s12 input-field">
						<input class="validate" id="cnss" name="cnss" type="text" value="{{ $user->cnss }}">
						<label>N° CNSS</label>
					</div>
					<div class="col s12 input-field">
						<input id="tel" name="tel" type="text" class="validate" value="{{ $user->tel }}">
						<label for="tel">Phone</label>
					</div>                      
					<div class="col s12 input-field">
						<input id="skype" name="skype" type="text" class="validate" value="{{ $user->skype }}">
						<label for="skype">Skype</label>
					</div>
					<div class="col s12">
						<label>Languages</label>
						<select class="browser-default" id="users-language-select2" name="laguage[]" multiple="multiple" size="80">								
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
				  <div class="col s12 m6">
					<div class="row">
					  <div class="col s12">
						<h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Personal Info</h6>
					  </div>
					  <div class="col s12 input-field">
						<input id="birthDate" name="birthDate" type="text" class="birthdate-picker datepicker" value="{{ $user->birthDate }}" data-error=".errorTxt4">
						<label for="birthDate">Birth date</label>
						<small class="errorTxt4"></small>
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
							<div class="col s12">
					</div>
					</div>
				  </div>
	  
				  <div class="col s12 display-flex justify-content-end mt-1">
					<button type="submit" class="btn indigo" name="action">
					  @lang('locale.Edit')</button>
					  
					<button type="button" class="btn btn-light" name="action"><a href="{{ route('isps.index') }}"></a> Cancel</button>
				  </div>
				</div>
			  </form>
			  <!-- users edit Info form ends -->
			</div>
		  </form>
		  </div>
		  <!-- </div> -->
		</div>
	  </div>
	</form>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/page-users.js')}}"></script>
@endsection