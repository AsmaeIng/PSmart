{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Provider')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Provider')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.Newprovider')</h4>
			<form method="POST" action="{{ route('providers.store') }}"  enctype="multipart/form-data">
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="name" type="text" name="name" >
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m3 s6">
						<input id="webSite" type="text" name="webSite">
						<label for="webSite">@lang('locale.webSite')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="note" type="text" name="note">
						<label for="note">@lang('locale.Note')</label>
					</div>
					<div class="col s3 file-field input-field">			
						<div class="waves-effect waves-light btn-small">
									<span>Logo <i class="material-icons right">cloud</i></span>
									<input type="file" name="image" multiple accept="image/*">
								  </div>
								  <div class="file-path-wrapper">
									<input class="file-path validate" id="image" name="image" type="text" placeholder="Upload one or more files">
								  </div>
								
								@if ($errors->has('files'))
									@foreach ($errors->get('files') as $error)
									<span class="invalid-feedback" role="alert">
										<strong>{{ $error }}</strong>
									</span>
									@endforeach
								  @endif	
				
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('providers.index') }}"></a> @lang('locale.Retour')
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