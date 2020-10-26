{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Country')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Country')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.Newcountry')</h4>
			<form method="POST" action="{{ route('countrys.store') }}" enctype="multipart/form-data">
			  @csrf
				<div class="row">
					<div class="input-field col m6 s12">
						<input id="name" type="text" name="name"   placeholder="name">
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m6 s12">
						<input id="sortname" type="text" name="sortname"   placeholder="sortname">
						<label for="sortname">@lang('locale.Sortname')</label>
					</div>
				</div>	
				<div class="row">
					<div class="input-field col m6 s12">
						<input id="phonecode" type="text" name="phonecode"   placeholder="phonecode">
						<label for="phonecode">@lang('locale.Phonecode')</label>
					</div>
					<div class="col m6 s12 file-field input-field">			
						<div class="float-right btn-floating mb-1 waves-effect waves-light gradient-45deg-orange-amber">
							<span><i class="material-icons">cloud_download</i></span>
							<input type="file">
						</div>
						<div class="file-path-wrapper">
							<i class="material-icons prefix">image</i>
							<input class="file-path validate" id="flag" name="flag" type="text">
						</div>
				
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('countrys.index') }}"></a> @lang('locale.Retour')
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