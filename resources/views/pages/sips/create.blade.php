{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add IP')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.IP')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.NewIP')</h4>
			<form method="POST" action="{{ route('sips.store') }}" name="myForm" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s12">
						<select id="id_domain" name="id_domain">
							@foreach($domains as $domain)							
								<option id="{{ $domain->id }}" value="{{ $domain->id }}">{{ $domain->name}}</option>
							@endforeach
						</select>			
						<label for="id_domain">@lang('locale.domain')  </label>
					</div>
					<div class="input-field col m3 s12">											
						<input name="random" id="random" width="50%" type="text" size="20" >
						<input type="button" style="color:#fff;" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" width="50%" value="@lang('locale.random')" onclick="newDomain()">						
					</div>
					<div class="input-field col m3 s12">
						<select id="server_id" name="server_id">
							@foreach($servers as $server)							
								<option id="{{ $server->id }}" value="{{ $server->id }}">{{ $server->alias}}</option>
							@endforeach
						</select>			
						<label for="id_domain">@lang('locale.server')  </label>
					</div>			  
					<div class="input-field col m3 s12">
						<input id="IP" type="text" name="IP">
						<label for="IP">@lang('locale.IP')</label>
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action" href="{{ route('sips.index') }}">@lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
<script src="{{asset('js/dictionary.js')}}"></script>
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection
