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
        <div class="card-content" > 
          <h4 class="card-title">@lang('locale.NewServer')</h4>
			<form method="POST" action="{{ route('servers.store') }}" enctype="multipart/form-data" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s12">
						<input id="alias" type="text" name="alias" value="Server {{ $lastOne->id +1 }}">
						<label for="alias">@lang('locale.Alias')</label>
					</div>
					<div class="input-field col m3 s12">
						<input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" placeholder="sale Date" value="">
						<label for="icon_attach_money">@lang('locale.SaleDate')</label>
					</div>			  
					<div class="input-field col m3 s12">
						<input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker" placeholder="sale Date" value="">			
						<label for="icon_short_text">@lang('locale.ExpirationDate')  </label>
					</div>
					<div class="input-field col m3 s12">
						<select id="typeSpamInbox" name="typeSpamInbox">
							<option value="1">INBOX</option>
							<option value="2">SPAM</option>
						</select>
						<label>SPAM / INBOX</label>
					</div>	
				</div>	
				<div class="row">
					<div class="input-field col m3 s12">
						<input id="userName" type="text" name="userName" value="root">
						<label for="userName">@lang('locale.USER')</label>
					</div>
					<div class="input-field col m3 s12">
						<input type="password" name="password"  id="password" >
						<label for="password">@lang('locale.Password')</label>
					</div>			  
					<div class="input-field col m3 s12">
						<input id="ip" name="ip" type="text">			
						<label for="ip">@lang('locale.IPMain')  </label>
					</div>
					<div class="col s3  input-field">			
						<select id="OS_id" name="OS_id">
							@foreach($operatingsystems as $os)							
								<option id="{{ $os->id }}" value="{{ $os->id }}">{{ $os->name}}</option>
							@endforeach
						</select>
						<label for="OS">@lang('locale.operatingsystems')</label>
							
					</div>
					
				</div>	
				<div class="row">					
					<div class="input-field col m3 s12">
						<input id="price" type="text" name="price">
						<label for="price">@lang('locale.price')</label>
					</div>
					<div class="input-field col m3 s12">
						<input type="text" name="sshPort"  id="sshPort" >
						<label for="sshPort">@lang('locale.sshPort')</label>
					</div>	
					<div class="col m3 s12  input-field">			
						<input type="text" name="panel"  id="panel" >
						<label for="panel">panels</label>
							
					</div>
					<div class="col m3 s12  input-field">			
						<select id="provider_id" name="provider_id">
							@foreach($provider as $provid)							
								<option  value="{{ $provid->id }}">{{$provid->name}}</option>
							@endforeach
						</select>
						<label for="provid">@lang('locale.Provider')</label>
					</div>					
				</div>
				<div class="row">
					
					<div class="input-field col m3 s12">
						<input type="text" name="user_providers"  id="user_providers" >
						<label for="user_providers">@lang('locale.userProviders')</label>
					</div>			  
					<div class="input-field col m3 s12">
						<input type="password" name="password_providers"  id="password_providers" >
						<label for="password_providers">@lang('locale.passwordProviders')</label>
					</div>
					<div class="input-field col m3 s12">
						<input type="text" name="NIP"  id="NIP" >
						<label for="NIP">@lang('locale.NIP')</label>
					</div>	
					<div class="input-field col m3 s12">
							<label style="padding-top: 35;">
								<input id="active" name="active" type="checkbox" checked="checked" />
								<span>@lang('locale.IsActive')</span>
							</label>
					</div>																														  										
				</div>						
				<div class="row">
					<div class="input-field col m4 s12">
						<select id="isps" name="isps[]" multiple="multiple" size="20">
							@foreach($isps as $isp)	
								<option  value="{{ $isp->name }}" >{{$isp->name}}</option>										
							@endforeach
						</select>
						<label for="ListeISPS">@lang('locale.ListeISPS')</label>
					</div>
					<div class="input-field col m4 s12">						
						<select id="mailers" name="mailers[]" multiple="multiple" size="20">
							@foreach($mailers as $mail)	
							<option  value="{{ $mail->mailer }}" >{{$mail->mailer}}</option>											
							@endforeach
						</select>		
						<label for="ListeMailers">@lang('locale.ListeMailers')  </label>
					</div>
					<div class="col m4 s12  input-field">			
						<select id="domain_id" name="domain_id">
							<option  value="">Select Domain</option>
							@foreach($domains as $domain)							
								<option  value="{{ $domain->id }}">{{$domain->name}}</option>
							@endforeach
						</select>
						<label for="domain">@lang('locale.Domain')</label>
					</div>					
				</div>
				<div class="row">
					
					<div class="input-field col m6 s12">
						<div class="file-field input-field" >
							<div class="waves-effect waves-light btn gradient-45deg-red-pink z-depth-4 mr-1 mb-2" style="height: 2rem;line-height: 2rem;">
								<span>@lang('locale.Liste')</span>
								<input type="file" name="listeIp"  accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
							</div>
							<div class="file-path-wrapper">
									<input class="file-path validate" style="height: 2rem;" id="listeIp" name="listeIp" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="input-field col m6 s12"></div>
				</div>
				
				<div class="row">
					<div class="input-field col m12 s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  href="{{ route('servers.index') }}"> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
<script src="{{asset('js/dictionary.js')}}"></script>
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }}
</script>
<style>
	#myDIV {
	  display: none;
	}
</style>
@endsection
@section('javascript')
@endsection