{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Role')
{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Role')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.NewRole')</h4>
			<form method="POST" action="{{ route('roles.store') }}" >
			  @csrf
				<div class="row">
                    <div class="input-field col m6 s12 {{ $errors->has('name') ? 'has-error' : '' }}">													
							<input type="text" id="name" name="name"  value="{{ old('name', isset($role) ? $role->name : '') }}">
							<label for="name">@lang('locale.name')*</label>
					</div>
					<div class="input-field col m6 s12">
						<input id="slug" type="text" name="slug"   placeholder="description">
						<label for="slug">Description</label>
					</div>
					<div class="col m12 s12 file-field input-field">			
						<select  class="browser-default" id="languageselect2" name="permissions[]" multiple="multiple" size="80">
							@foreach($permissions as $id => $permissions)
								<option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
									{{ $permissions }}
								</option>
							@endforeach
						</select>
						<label for="permissions">@lang('locale.permissions')</label>							
					</div>		  
				</div>			
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('roles.index') }}"></a> @lang('locale.Retour')
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
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
@endsection