{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Network')

{{-- main page content --}}
@section('content')
<script type="text/javascript">
window.document.getElementById("div").disabled=false;
</script>
<div  name="div" class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Network')</h4>

          <form  method="GET">
            <div class="row">
				<div class="input-field col m3 s6">
					<input id="name" type="text" name="name" value="{{ $networks->name }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);" >
					<label for="name">@lang('locale.Name')</label>
				</div> 
				<div class="input-field col m3 s6">
					<select id="plateform_id" name="plateform_id">
						@foreach($plateforms as $net)	
                        @if (@$networks->plateform_id===$net->id)						
							<option id="{{ $net->id }}" name="{{ $net->id }}" value="{{ $net->id }}" selected  disabled="true">{{ $net->name}}</option>
                        @endif
						@endforeach
					</select>
					
					<label for="PlateformSponsor">@lang('locale.PlateformSponsor')</label>
				</div>			  
				<div class="input-field col m3 s6">
						<input id="login" type="text" name="login" value="{{ $networks->login }}"  placeholder="login" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="PremierPaiement">@lang('locale.login')</label>
				</div>
				<div class="input-field col m3 s6">
					<input id="password" type="text" name="password" value="{{ $networks->password }}"  placeholder="password" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="password">@lang('locale.password')</label>
				</div>				
            </div>
			<div class="row">
				
				<div class="input-field col m3 s6">
					<input id="URLSignIn" type="text" name="URLSignIn" value="{{ $networks->URLSignIn }}"  placeholder="URLSignIn" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="URLSignIn">@lang('locale.URLSignIn')</label>
				</div>
				<div class="input-field col m3 s6">
					<input id="siteweb" type="text" name="APIAccessKey" value="{{ $networks->APIAccessKey }}"  placeholder="APIAccessKey" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="APIAccessKey">@lang('locale.APIAccessKey')</label>
				</div>
				<div class="input-field col m3 s12">
					<input id="APIHostURL" type="text" name="APIHostURL" value="{{ $networks->APIHostURL }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);" >
					<label for="APIHostURL">@lang('locale.APIHostURL')</label>
				</div>				
				<div class="input-field col m3 s6">
					<input id="AffiliateID" type="text" name="AffiliateID" value="{{ $networks->AffiliateID }}"  placeholder="AffiliateID" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="AffiliateID">@lang('locale.AffiliateID')</label>
				</div>
				
            </div>
			<div class="row">
				<div class="input-field col m3 s6">
						<input id="token" type="text" name="token" value="{{ $networks->token }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="token">Token</label>
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
				<div class="input-field col m3 s6 media">		
					 @foreach($logonetworks as $network)	
					  <img src="/{{$network->path}}/{{$network->name}}" class="border-radius-4" alt="{{$network->name}}" height="100%" width="100%">
					@endforeach								
				</div>
				<div class="input-field col m3 s12">
				</div>		  
			  			                
            </div>

              <div class="row">
					<div class="input-field col s12">
			
						<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action" href="{{ route('networks.index') }}"> @lang('locale.Retour')
							<i class="material-icons right">keyboard_return</i>
						</a>
					</div>
											
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