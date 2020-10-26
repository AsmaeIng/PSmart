{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Network')

{{-- main page content --}}
@section('content')

<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Network')</h4>

          <form action="{{ route('networks.update',$networks->id) }}" method="POST" enctype="multipart/form-data">
		  @csrf
		  @method('PUT')
            <div class="row">
				<div class="input-field col m3 s12">
					<input id="name" type="text" name="name" value="{{ $networks->name }}"  placeholder="name">
					<label for="name">@lang('locale.Name')</label>
				</div> 
				<div class="input-field col m3 s12">
					<select id="plateform_id" name="plateform_id">
						@foreach($plateforms as $net)	
                        @if (@$networks->plateform_id===$net->id)						
							<option id="{{ $net->id }}" name="{{ $net->id }}" value="{{ $net->id }}"selected>{{ $net->name}}</option>
                        @else
                            <option id="{{ $net->id }}"name="{{ $net->id }}" value="{{ $net->id }}">{{ $net->name}}</option>
                        @endif
						@endforeach
					</select>
					<label for="PlateformSponsor">@lang('locale.PlateformSponsor')</label>
				</div>			  
				<div class="input-field col m3 s12">
						<input id="login" type="text" name="login" value="{{ $networks->login }}"  placeholder="login">
						<label for="PremierPaiement">@lang('locale.login')</label>
				</div>
				<div class="input-field col m3 s12">
					<input id="password" type="text" name="password" value="{{ $networks->password }}"  placeholder="password">
					<label for="password">@lang('locale.password')</label>
				</div>
				
            </div>
			<div class="row">
				
				<div class="input-field col m3 s12">
					<input id="URLSignIn" type="text" name="URLSignIn" value="{{ $networks->URLSignIn }}"  placeholder="URLSignIn">
					<label for="URLSignIn">@lang('locale.URLSignIn')</label>
				</div>
				<div class="input-field col m3 s12">
					@foreach($logonetworks as $network)	
					  <center><img src="/{{$network->path}}/{{$network->name}}" class="border-radius-4" alt="{{$network->name}}" height="100%" width="100%"></center>
					@endforeach
				</div>
				<div class="file-field input-field col m3 s12">								
					<div class="waves-effect waves-light btn-small">
						<span>Logo <i class="material-icons right">cloud</i></span>
						<input type="file" name="image" multiple accept="image/*">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" id="image" name="image" type="text" placeholder="Upload one or more files">
					</div>					 
                </div>
				<div class="input-field col m3 s12">				
					<label>
							@if($networks->type == 'on')
								<input id="type" name="type" type="checkbox" checked="checked" />
							@elseif($networks->type =='NULL' or $networks->type =='')
								<input id="type" name="type" type="checkbox"  />
							@endif
								<span>@lang('locale.IsActive')</span>
					</label>
				</div>	
				
            </div>
			<div class="row">
				<div class="input-field col m3 s12">
					<input id="AffiliateID" type="text" name="AffiliateID" value="{{ $networks->AffiliateID }}"  placeholder="AffiliateID">
					<label for="AffiliateID">@lang('locale.AffiliateID')</label>
				</div>
				<div class="input-field col m3 s12">
					<input id="siteweb" type="text" name="APIAccessKey" value="{{ $networks->APIAccessKey }}"  placeholder="APIAccessKey">
					<label for="APIAccessKey">@lang('locale.APIAccessKey')</label>
				</div>
				<div class="input-field col m3 s12">
					<input id="APIHostURL" type="text" name="APIHostURL" value="{{ $networks->APIHostURL }}" >
					<label for="APIHostURL">@lang('locale.APIHostURL')</label>
				</div>
				<div class="input-field col m3 s6">
						<input id="token" type="text" name="token" value="{{ $networks->token }}" >
						<label for="token">Token</label>
				</div>
						  			  			                
            </div>
			<div class="row">
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
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
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection