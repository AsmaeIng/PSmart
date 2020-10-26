{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Servers')

{{-- main page content --}}
@section('content')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#active").click(function () {
            if ($(this).is(":checked")) {
                $("#myDIV").show();
            } else {
                $("#myDIV").hide();
            }
        });
    });
</script>
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy" onload="newDomain()">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Servers')</h4>
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
          <form action="{{ route('servers.update',$servers->id) }}" method="POST" name="myForm">
		  @csrf
		  @method('PUT')
            <div class="row">
				<div class="input-field col m3 s6">
					<input type="text" id="alias" name="alias" value="{{ $servers->alias}}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="alias">@lang('locale.Alias')</label>
				</div>				
				<div class="input-field col m3 s6">
					<input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" value="{{ $servers->saleDate }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="icon_attach_money">@lang('locale.SaleDate')</label>
				</div>
				<div class="input-field col m3 s6">
					<input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker"  value="{{ $servers->expirationDate }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">			
					<label for="icon_short_text">@lang('locale.ExpirationDate')  </label>
				</div> 
				<div class="input-field col m3 s6">
						<select id="typeSpamInbox" name="typeSpamInbox">
							
							@if($servers->typeSpamInbox == '1')
							<option value="{{ $servers->typeSpamInbox }}" disabled selected> INBOX </option>
							@elseif ($servers->typeSpamInbox == '2')
							 <option value="{{ $servers->typeSpamInbox }}" disabled selected> SPAM </option>
							 @endif
						</select>
						<label>SPAM/INBOX</label>
					</div>	
				
			</div> 
			<div class="row">
				<div class="input-field col m3 s6">
					<input type="text" id="userName" name="userName" value="{{ $servers->userName }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="userName">@lang('locale.USER')</label>
				</div>				
				<div class="input-field col m3 s12">
					<input type="password" name="password"  id="password"   value="{{ $servers->password }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="password">@lang('locale.password')</label>
					<span class="show-password" id="eye1">afficher</span>
				</div>
				<div class="input-field col m3 s12">
					<input id="ip" name="ip" type="text" value="{{ $servers->ip }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">		
					<label for="icon_short_text">@lang('locale.IPMaine')  </label>
				</div>              
				<div class="col m3 s12 file-field input-field">			
					<select id="OS_id" name="OS_id">
						@foreach($operatingsystems as $os)	
							@if (@$os->id===$servers->OS_id)						
								<option id="{{ $os->id }}" name="{{ $os->id }}" value="{{ $os->id }}" disabled selected>{{ $os->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="OS">@lang('locale.operatingsystems')</label>					
				</div>
			</div>
			<div class="row">
				<div class="col m3 s12 file-field input-field">			
					<select id="domain_id" name="domain_id">						
						@foreach($domains as $domain)	
							@if (@$domain->id===$servers->domain_id)						
								<option id="{{ $domain->id }}" name="{{ $domain->id }}" value="{{ $domain->id }}" disabled selected>{{ $domain->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Domain')</label>					
				</div>
				<div class="input-field col m3 s12">											
						<input type="text" name="random"  id="random"   value="{{ $servers->random }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="random">@lang('locale.random')</label>							
				</div>
				<div class="input-field col m3 s12">
					<input type="text" id="price" name="price" value="{{ $servers->price }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="price">@lang('locale.price')</label>
				</div> 				
				<div class="input-field col m3 s12">
					<input type="text" name="sshPort"  id="sshPort"   value="{{ $servers->sshPort }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="sshPort">@lang('locale.sshPort')</label>
				</div>				          				
			</div>
			<div class="row">
				<div class="col m3 s12 file-field input-field">			
					<select id="provider_id" name="provider_id">						
						@foreach($providers as $prov)	
                        @if (@$prov->id===$servers->provider_id)						
							<option id="{{ $prov->id }}" name="{{ $prov->id }}" value="{{ $prov->id }}" disabled selected>{{ $prov->name}}</option>
                        @endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Provider')</label>
				</div>
				<div class="input-field col m3 s12">
					<input type="text" name="user_providers"  id="user_providers" value="{{ $servers->user_providers }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="user_providers">@lang('locale.userProviders')</label>
				</div>			  
				<div class="input-field col m3 s12">
					<input type="password" name="password_providers"  id="password_providers" value="{{ $servers->password_providers }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="password_providers">@lang('locale.passwordProviders')</label>
					<span class="show-password" id="eye">afficher</span>
				</div>											
				<div class="col s3 file-field input-field">			
					<input type="text" name="panel"  id="panel" value="{{ $servers->panel }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="panel">panels</label>
							
				</div>																		  
										
			</div>
			<div class="row">
				
				<div class="input-field col m4 s12">
					<input type="text" name="NIP"  id="NIP" value="{{ $servers->NIP }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					<label for="NIP">@lang('locale.NIP')</label>
				</div>
				<div class="input-field col m4 s12">
						<select id="server_id" name="server_id"  >								
							@foreach($sips as $sip)								
							<option  value="{{ $sip->id }}" >{{$sip->IP}}</option>											
							@endforeach
						</select>
						<label for="ListeISPS">@lang('locale.ListeISPS')</label>
				</div>
				<div class="input-field col m4 s12">            
					<label>
						@if($servers->active == 'on')
							<input id="active" name="active" type="checkbox" checked="checked" />
						@elseif($servers->active =='NULL' or $servers->active =='')
							<input id="active" name="active" type="checkbox"  />
						@endif
						<span>@lang('locale.IsActive')</span>
					</label>
				</div>			
			</div>
			<div class="row">
				@if($servers->active == 'on')
				<div id="myDIV">
					<div class="input-field col m4 s12">
						<select id="isps" name="isps[]" multiple="multiple" size="20">								
							@foreach($isps as $isp)	
								@if(strpos($servers->isps, $isp->name) !== false)
								<option value="{{ $isp->name }}"  selected >{{$isp->name}}</option>
								@else
								<option  value="{{ $isp->name }}" >{{$isp->name}}</option>
								@endif											
							@endforeach														
						</select>
						<label for="ListeISPS">@lang('locale.ListeISPS')</label>
					</div>
					<div class="input-field col m4 s12">
						<select id="mailers" name="mailers[]" multiple="multiple" size="20">								
							@foreach($mailers as $mail)	
								@if(strpos($servers->mailers, $mail->mailer) !== false)
								<option value="{{ $mail->mailer }}"  selected >{{$mail->mailer}}</option>
								@else
								<option  value="{{ $mail->mailer }}" >{{$mail->mailer}}</option>
								@endif											
							@endforeach
						</select>		
						<label for="ListeMailers">@lang('locale.ListeMailers')  </label>
					</div>              
				</div>
				@endif
			</div>	
			<div class="row">
				<div class="input-field col m12 s12">
					<select id="sips" name="sips[]" multiple="multiple" size="20">								
						@foreach($sips as $sip)	

							@if(strpos($servers->ips, $sip->IP) !== false)
								<option value="{{ $sip->id }}"  selected >{{$sip->IP}}</option>
							@else
								<option  value="{{ $sip->id }}" >{{$sip->IP}}</option>
							@endif											
						@endforeach
					</select>
					<label for="ListeISPS">IP </label>
				</div>
			
			</div>
			<div class="row">
				<div class="input-field col s12">
					
					<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('servers.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					</button>
				</div>
											
			</div>
          </form>
        </div>
    </div>
</div>	   
@endsection
{{-- page scripts --}}
@section('page-script')
<style>
.show-password {
	font-size: 9px;
	text-transform: uppercase;
	position: absolute;
	cursor: pointer;
	margin-left: -48px;
}
</style>

<script>
document.getElementById("eye").addEventListener("click", function(e){
        var pwd = document.getElementById("password_providers");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
        } else {
            pwd.setAttribute("type","password");
        }
    });
document.getElementById("eye1").addEventListener("click", function(e){
        var pwd1 = document.getElementById("password");
        if(pwd1.getAttribute("type")=="password"){
            pwd1.setAttribute("type","text");
        } else {
            pwd1.setAttribute("type","password");
        }
    });
</script>
<script src="{{asset('js/dictionary.js')}}"></script>
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>

@endsection