{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Isp')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Isp')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.Newisp')</h4>
			<form method="POST" action="{{ route('isps.store') }}" enctype="multipart/form-data" >
			  @csrf
				<div class="row">
					<div class="input-field col m4 s12">
						<input id="name" type="text" name="name"   placeholder="name">
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m4 s12">
						<input id="emailTeste" type="email" name="emailTeste"   placeholder="emailTeste">
						<label for="emailTeste">@lang('locale.emailTeste')</label>
					</div>
					<div class="input-field col m4 s12">
						<input id="url" type="text" name="url" placeholder="emailTeste">
						<label for="url">URL</label>
					</div>			  
				</div>	
				<div class="row">					
					<div class="col m6 s12 file-field input-field">			
						<div class="waves-effect waves-light btn-small">
							<span>Logo <i class="material-icons right">cloud</i></span>
							<input type="file" name="image" multiple accept="image/*">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" id="image" name="image" type="text" placeholder="Upload one or more files">
						</div>				
					</div>
					<div class="input-field col m6 s12">
						<label>
							<input id="type" name="type" type="checkbox" checked="checked" />
							<span>@lang('locale.IsActive')</span>
						</label>
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('isps.index') }}"></a> @lang('locale.Retour')
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