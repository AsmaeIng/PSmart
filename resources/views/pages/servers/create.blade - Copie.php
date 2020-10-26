{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Server')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Servers')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.NewServer')</h4>
			<form method="POST" action="{{ route('servers.store') }}" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="alias" type="text" name="alias">
						<label for="alias">@lang('locale.Alias')</label>
					</div>
					<div class="input-field col m3 s6">
						<input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" placeholder="sale Date" value="14/11/2019">
						<label for="saleDate">@lang('locale.SaleDate')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker" placeholder="sale Date" value="14/11/2019">			
						<label for="expirationDate">@lang('locale.ExpirationDate')  </label>
					</div>
					<div class="col s3 file-field input-field">			
						<select id="provider_id" name="provider_id">
							@foreach($provider as $prov)							
								<option id="{{ $prov->id }}" value="{{ $prov->id }}">{{ $prov->name}}</option>
							@endforeach
						</select>
						<label for="Provider">@lang('locale.Provider')</label>
							
					</div>
				</div>	
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="userName" type="text" name="userName">
						<label for="userName">@lang('locale.USER')</label>
					</div>
					<div class="input-field col m3 s6">
						<input type="text" name="password"  id="password" >
						<label for="password">@lang('locale.password')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="ip" name="ip" type="text">			
						<label for="ip">@lang('locale.IPMain')  </label>
					</div>
					<div class="col s3 file-field input-field">			
						<select id="provider_id" name="provider_id">
							@foreach($domains as $domain)							
								<option id="{{ $domain->id }}" value="{{ $domain->id }}">{{ $domain->name}}</option>
							@endforeach
						</select>
						<label for="Provider">@lang('locale.Domain')</label>
							
					</div>
				</div>	
				<div class="row">
					<div class="col s3 file-field input-field">			
						<select id="OS_id" name="OS_id">
							@foreach($operatingsystems as $os)							
								<option id="{{ $os->id }}" value="{{ $os->id }}">{{ $os->name}}</option>
							@endforeach
						</select>
						<label for="OS">@lang('locale.OS')</label>
							
					</div>
					<div class="input-field col m3 s6">
						<input id="price" type="text" name="price">
						<label for="price">@lang('locale.price')</label>
					</div>
					<div class="input-field col m3 s6">
						<input type="text" name="sshPort"  id="sshPort" >
						<label for="sshPort">@lang('locale.sshPort')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<select id="isps_id" name="isps_id">
							@foreach($isps as $isp)							
								<option id="{{ $isp->id }}" value="{{ $isp->id }}">{{ $isp->name}}</option>
							@endforeach
						</select>			
						<label for="isps">@lang('locale.ListeISPS')  </label>
					</div>					
				</div>
				<div class="row">
					<div class="col s3 file-field input-field">			
						<select id="os_id" name="os_id">
							@foreach($mailers as $os)							
								<option id="{{ $os->id }}" value="{{ $os->id }}">{{ $os->name}}</option>
							@endforeach
						</select>
						<label for="os">@lang('locale.ListeMailers')</label>
							
					</div>
					<div class="input-field col m3 s6">

					</div>
					<div class="input-field col m3 s6">

					</div>			  
					<div class="input-field col m3 s6">
	
					</div>					
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="btn cyan waves-effect waves-light left"  name="action"><a href="{{ route('servers.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection