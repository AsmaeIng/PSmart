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
					<input type="text" id="alias" name="alias" value="{{ $servers->alias}}">
					<label for="alias">@lang('locale.Alias')</label>
				</div>				
				<div class="input-field col m3 s6">
					<input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" value="{{ $servers->saleDate }}">
					<label for="icon_attach_money">@lang('locale.SaleDate')</label>
				</div>
				<div class="input-field col m3 s6">
					<input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker"  value="{{ $servers->expirationDate }}">			
					<label for="icon_short_text">@lang('locale.ExpirationDate')  </label>
				</div> 
				<div class="input-field col m3 s6">
						<select id="typeSpamInbox" name="typeSpamInbox">
							
							@if($servers->typeSpamInbox == '1')
							<option value="{{ $servers->typeSpamInbox }}" disabled selected> INBOX </option>
							@elseif ($servers->typeSpamInbox == '2')
							 <option value="{{ $servers->typeSpamInbox }}" disabled selected> SPAM </option>
							 @endif
							 
							<option value="1">INBOX</option>
							<option value="2">SPAM</option>
						</select>
						<label>SPAM/INBOX</label>
					</div>	
				
			</div> 
			<div class="row">
				<div class="input-field col m3 s6">
					<input type="text" id="userName" name="userName" value="{{$servers->userName}}">
					<label for="userName">@lang('locale.USER')</label>
				</div>				
				<div class="input-field col m3 s6">
					<input type="password" name="password"  id="password"   value="{{$servers->password}}">
					<label for="password">@lang('locale.password')</label>
					<span class="show-password" id="eye1">afficher</span>
				</div>
				<div class="input-field col m3 s6">
					<input id="ip" name="ip" type="text" " value="{{ $servers->ip }}">			
					<label for="icon_short_text">@lang('locale.IPMaine')  </label>
				</div>              
				<div class="col m3 s6 file-field input-field">			
					<select id="OS_id" name="OS_id">
						@foreach($operatingsystems as $os)	
							@if (@$os->id===$servers->OS_id)						
								<option id="{{ $os->id }}" name="{{ $os->id }}" value="{{ $os->id }}" selected>{{ $os->name}}</option>
							@else
								<option id="{{ $os->id }}"name="{{ $os->id }}" value="{{ $os->id }}">{{ $os->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="OS">@lang('locale.operatingsystems')</label>					
				</div>
			</div>
			<div class="row">
				<div class="col m3 s6 file-field input-field">			
					<select id="domain_id" name="domain_id">						
						@foreach($domains as $domain)	
							@if (@$domain->id===$servers->domain_id)						
								<option id="{{ $domain->id }}" name="{{ $domain->id }}" value="{{ $domain->id }}" selected>{{ $domain->name}}</option>
							@else
								<option id="{{ $domain->id }}"name="{{ $domain->id }}" value="{{ $domain->id }}">{{ $domain->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Domain')</label>					
				</div>
				<div class="input-field col m3 s12">											
					<input name="random" id="random" width="50%" type="text" size="20"  value="{{ $servers->random }}" >
					<input type="button" style="color:#fff;" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round z-depth-4 mr-1 mb-2" width="50%" value="@lang('locale.random')" onclick="newDomain()">						
				</div>
				<div class="input-field col m3 s6">
					<input type="text" id="price" name="price" value="{{ $servers->price }}">
					<label for="price">@lang('locale.price')</label>
				</div> 				
				<div class="input-field col m3 s6">
					<input type="text" name="sshPort"  id="sshPort"   value="{{ $servers->sshPort }}">
					<label for="sshPort">@lang('locale.sshPort')</label>
				</div>				          				
			</div>
			<div class="row">
				<div class="col m3 s6 file-field input-field">			
					<select id="provider_id" name="provider_id">						
						@foreach($providers as $prov)	
							@if (@$prov->id===$servers->provider_id)						
								<option id="{{ $prov->id }}" name="{{ $prov->id }}" value="{{ $prov->id }}" selected>{{ $prov->name}}</option>
							@else
								<option id="{{ $prov->id }}" name="{{ $prov->id }}" value="{{ $prov->id }}" >{{ $prov->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Provider')</label>
				</div>
				<div class="input-field col m3 s6">
					<input type="text" name="user_providers"  id="user_providers" value="{{$servers->user_providers}}" >
					<label for="user_providers">@lang('locale.userProviders')</label>
				</div>			  
				<div class="input-field col m3 s6">
					<input type="password" name="password_providers"  id="password_providers" value="{{$servers->password_providers}}" >
					<label for="password_providers">@lang('locale.passwordProviders')</label>
					<span class="show-password" id="eye">afficher</span>
				</div>											
				<div class="col s3 file-field input-field">			
					<input type="text" name="panel"  id="panel" value="{{ $servers->panel }}" >
					<label for="panel">panels</label>
							
				</div>																		  
										
			</div>
			<div class="row">
				
				<div class="input-field col m3 s6">
					<input type="text" name="NIP"  id="NIP" value="{{ $servers->NIP }}" >
					<label for="NIP">@lang('locale.NIP')</label>
				</div>
				<div class="input-field col m3 s6">            
					<label>
						@if($servers->active == 'on')
							<input id="active" name="active" type="checkbox" checked="checked" />
						@elseif($servers->active =='NULL' or $servers->active =='')
							<input id="active" name="active" type="checkbox"  />
						@endif
						<span>@lang('locale.IsActive')</span>
					</label>
				</div>				
				<div id="myDIV">
					<div class="input-field col m3 s6">
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
					<div class="input-field col m3 s6">
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

			</div>	
			
			<div class="row">
				<div class="input-field col m6 s12">
					<select id="sip" name="sip[]" multiple="multiple" size="20">								
						@foreach($sips as $sip)	

							@if(strpos($servers->ips, $sip->IP) !== false)
								<option value="{{ $sip->IP }}"  selected >{{$sip->IP}}</option>
							@elseif(@$servers->id===$sip->server_id)
								<option value="{{ $sip->IP }}"  selected >{{$sip->IP}}</option>
							@else
								<option  value="{{ $sip->IP }}" >{{$sip->IP}}</option>
							@endif											
						@endforeach
					</select>
					<label for="ListeISPS">IP </label>
				</div>
				<div class="input-field col m6 s12">
					<input type="text" name="ips"  id="ips"  value="" >
					<label for="ips">@lang('locale.newIP')</label>
				</div>
			
			</div>
			<div class="row">
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					</button>
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