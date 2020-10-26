{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'IP')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.IP')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.IP')</h4>
		  @if ($errors->any())
								<div class="alert alert-danger">
									<strong>Warning!</strong> Please check input field code<br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
          <form action="" method="GET">
				<div class="row">
					<div class="input-field col m3 s12">
						<select id="server_id" name="server_id">							
						@foreach($servers as $ser)		
							@if (@$sip->server_id===$ser->id)						
								<option id="{{ $ser->id }}" name="{{ $ser->id }}" value="{{ $ser->id }}" disabled selected>{{$ser->alias}}</option>
							@endif
						@endforeach
						</select>						
					</div>
					<div class="input-field col m3 s12">
						<select id="id_domain" name="id_domain">							
							@foreach($domains as $domain)		
								@if (@$sip->id_domain===$domain->id)						
									<option id="{{ $domain->id }}" name="{{ $domain->id }}" value="{{ $domain->id }}" disabled selected>{{$domain->name}}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="input-field col m3 s12">											
						<input type="text" name="random"  id="random"   value="{{ $sip->random }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="random">@lang('locale.random')</label>							
				</div>
					<div class="input-field col m3 s12">
						<input type="text" id="IP" name="IP" value="{{ $sip->IP }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="IP">@lang('locale.IP')</label>
					</div>              
				</div>
				<div class="row">
					<div class="input-field col s12">
					<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"   href="{{ route('sips.index') }}"> @lang('locale.Retour')
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