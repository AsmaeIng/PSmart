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
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Servers') </h4>
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
          <form action="{{ route('servers.update',$server->id) }}" method="POST" name="myForm">
		  @csrf
		  @method('PUT')
            <div class="row">
				<div class="input-field col m3 s6">					
					<input type="text" id="alias" name="alias" value="{{ $server->alias}}">
					<label for="alias">@lang('locale.Alias')</label>
				</div>	
				<div class="input-field col m3 s6">
					<input type="text" id="userName" name="userName" value="{{ $server->userName }}">
					<label for="userName">@lang('locale.USER')</label>
				</div>				
				<div class="input-field col m3 s6">
					<input type="password" name="password"  id="password"   value="{{ $server->password }}">
					<label for="password">@lang('locale.password')</label>
					<span class="show-password" id="eye1">afficher</span>
				</div>
				<div class="input-field col m3 s6">
						<select id="typeSpamInbox" name="typeSpamInbox">
							
							@if($server->typeSpamInbox == '1')
							<option value="{{ $server->typeSpamInbox }}" disabled selected> INBOX </option>
							@elseif ($server->typeSpamInbox == '2')
							 <option value="{{ $server->typeSpamInbox }}" disabled selected> SPAM </option>
							 @endif
							 
							<option value="1">INBOX</option>
							<option value="2">SPAM</option>
						</select>
						<label>SPAM/INBOX</label>
					</div>	
				
			</div> 
			<div class="row">
				
				<div class="input-field col m3 s6">
					<input id="ip" name="ip" type="text" " value="{{ $server->ip }}">			
					<label for="icon_short_text">@lang('locale.IPMaine')  </label>
				</div>              
				<div class="col m3 s6 file-field input-field">			
					<select id="OS_id" name="OS_id">
						@foreach($operatingsystems as $os)	
                        @if (@$os->id===$server->OS_id)						
							<option id="{{ $os->id }}" name="{{ $os->id }}" value="{{ $os->id }}" selected>{{ $os->name}}</option>
                        @else
                            <option id="{{ $os->id }}"name="{{ $os->id }}" value="{{ $os->id }}">{{ $os->name}}</option>
                        @endif
						@endforeach
					</select>
					<label for="OS">@lang('locale.operatingsystems')</label>					
				</div>
				<!--<div class="col m3 s6 file-field input-field">			
					<select id="domain_id" name="domain_id">						
						@foreach($domains as $domain)	
                        @if (@$domain->id===$server->domain_id)						
							<option id="{{ $domain->id }}" name="{{ $domain->id }}" value="{{ $domain->id }}"  selected>{{ $domain->name}}</option>
                        @else
                            <option id="{{ $domain->id }}"name="{{ $domain->id }}" value="{{ $domain->id }}">{{ $domain->name}}</option>
                        @endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Domain')</label>									
				</div>-->
				<div class="col m3 s12 file-field input-field">			
					<select id="domain_id" name="domain_id">						
						@foreach($domains as $domain)	
							@if (@$domain->id===$server->domain_id)						
								<option id="{{ $domain->id }}" name="{{ $domain->id }}" value="{{ $domain->id }}" disabled selected>{{ $domain->name}}</option>
							@endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Domain')</label>					
				</div>
				<!--<div class="input-field col m3 s12">											
						<input name="random" id="random" width="50%" type="text" size="20" value="{{ $server->random }}"  >
						<input type="button" style="color:#fff;" class="waves-effect waves-light btn gradient-45deg-amber-amber z-depth-4 mr-1 mb-2 border-round" width="50%" value="@lang('locale.random')" onclick="newDomain()">						
													
				</div>-->
				<div class="input-field col m3 s12">											
						<input type="text" name="random"  id="random"   value="{{ $server->random }}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						<label for="random">@lang('locale.random')</label>							
				</div>
			</div>
			<div class="row">
				<div class="col m3 s12 file-field input-field">			
					<select id="provider_id" name="provider_id">						
						@foreach($providers as $prov)	
                        @if (@$domain->id===$server->provider_id)						
							<option id="{{ $prov->id }}" name="{{ $prov->id }}" value="{{ $prov->id }}" selected>{{ $prov->name}}</option>
                        @else
                            <option id="{{ $prov->id }}" name="{{ $prov->id }}" value="{{ $prov->id }}">{{ $prov->name}}</option>
                        @endif
						@endforeach
					</select>
					<label for="domains">@lang('locale.Provider')</label>
				</div>
				<div class="input-field col m3 s12">
					<input type="text" name="sshPort"  id="sshPort"   value="{{ $server->sshPort }}">
					<label for="sshPort">@lang('locale.sshPort')</label>
				</div>				          				
				<div class="input-field col m3 s12">
						<select id="ips" name="ips"  >								
							@foreach($sips as $sip)								
							<option  value="{{ $sip->id }}" >{{$sip->IP}}</option>											
							@endforeach
						</select>
						<label for="ListeISPS">@lang('locale.ListeIP')</label>
				</div>
				<div class="input-field col m3 s12">            
					<label>
						@if($server->active == 'on')
							<input id="active" name="active" type="checkbox" checked="checked" />
						@elseif($server->active =='NULL' or $server->active =='')
							<input id="active" name="active" type="checkbox"  />
						@endif
						<span>@lang('locale.IsActive')</span>
					</label>
				</div>
				
			</div>
			<div class="row">
				<div id="myDIV">
					<div class="input-field col m6 s12">
						<select id="isps" name="isps[]" multiple="multiple" size="20">								
							@foreach($isps as $isp)	
							@if(strpos($server->isps, $isp->name) !== false)
							<option value="{{ $isp->name }}"  selected >{{$isp->name}}</option>
							@else
							<option  value="{{ $isp->name }}" >{{$isp->name}}</option>
							@endif								
			
							@endforeach
						</select>
						<label for="ListeISPS">@lang('locale.ListeISPS')</label>
					</div>
					<div class="input-field col m6 s12">
						<select id="mailers" name="mailers[]" multiple="multiple" size="20">								
							@foreach($mailers as $mail)	
							@if(strpos($server->mailers, $mail->mailer) !== false)
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
				<div class="input-field col s12">
					<!--<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					</button>-->
					
					
				<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  href="{{ route('servers.index') }}"> @lang('locale.Retour')</a>
						<i class="material-icons right">keyboard_return</i>
					
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