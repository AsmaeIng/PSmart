{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Imap')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Imap')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.Newimap')</h4> 
			<form method="POST" action="{{ route('imaps.getImap') }}" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<select id="id_isps" name="id_isps">
							@foreach($isps as $isp)							
								<option id="{{ $isp->id }}" value="{{ $isp->name }}">{{ $isp->name}}</option>
							@endforeach
						</select>			
						<label for="isps">@lang('locale.ListeISPS')  </label>
					</div>
					<div class="input-field col m3 s6">
						<input id="Email" type="email" class="validate" name="Email"   placeholder="Email">
						<label for="Email">@lang('locale.Email')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="Password" type="password" class="validate" name="Password"   placeholder="Password">
						<label for="Password">@lang('locale.Password')</label>
					</div>
					<div class="input-field col m3 s6">					
						<select id="Folder" name="Folder">
							<option value="INBOX">INBOX</option>
							<option value="SPAM">SPAM</option>
						</select>
						<label>Folder</label>			
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 waves-light right" type="submit" name="action">@lang('locale.GO')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left" href="{{ route('imaps.index') }}">@lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </a>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection