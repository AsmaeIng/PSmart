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
        <div class="card-content" onload="newDomain()"> 
          <h4 class="card-title">@lang('locale.NewServer')</h4>
			<form  method="POST" action="{{ route('servers.store') }}" name="myForm" >
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
						<div > 
							<form >
							<center>Your new site: <input name="theDomain" type="text" size="20" value="If this message is here, you have no JS. lol">
							<input type="button" value="Generate another domain" onclick="newDomain()"></center>
							</form>

						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col s3 file-field input-field">			
							
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

					</div>					
				</div>
				<div class="row">
					<div class="col s3 file-field input-field">			

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
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
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
@section('javascript')
<script src="{{asset('js/dictionary.js')}}"></script>


@endsection