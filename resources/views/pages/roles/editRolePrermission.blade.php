{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Role')

{{-- main page content --}}
@section('content')
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
@endsection

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Role')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Role')</h4>
          <form action="{{ route('roles.updateRolePrermission',$roles->id) }}" method="POST">
		  @csrf
		  @method('PUT')
			<div class="row">
				<div class="input-field col m6 s12">
					<input type="text" id="name" name="name" value="{{ $roles->name }}" placeholder="">
					<label for="name">@lang('locale.Name')</label>
				</div>
				<div class="input-field col m6 s12">
					<input id="slug" type="text" name="slug" value="{{ $roles->slug }}" placeholder="">
					<label for="slug">Description</label>
				</div>	
				<div class="input-field col m6 s12">
					<div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
						<label for="permissions">@lang('locale.permissions')*
						<select name="permissions[]" id="languageselect2" class="browser-default" multiple="multiple">
						   @foreach($permissions as $id => $permissions)
								<option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
									{{ $permissions }}
								</option>
							@endforeach
						</select>
                
					</div>	
				</div>
            </div>
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
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
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
<script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

