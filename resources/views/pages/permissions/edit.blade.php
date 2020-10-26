{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Permission')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Permission')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Permission')</h4>
        <form action="{{ route("permissions.update", [$permission->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
			<div class="row">
				<div class="input-field col m4 s12 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label for="name">{{ trans('global.permission.fields.name') }}*</label>
					<input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($permission) ? $permission->name : '') }}">
					@if($errors->has('name'))
						<p class="help-block">
							{{ $errors->first('name') }}
						</p>
					@endif

				</div>            
				<div class="input-field col m4 s12 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
					<label for="description">{{ trans('global.permission.fields.description') }}*</label>
					<input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($permission) ? $permission->description : '') }}">
					@if($errors->has('description'))
						<p class="help-block">
							{{ $errors->first('description') }}
						</p>
					@endif

				</div>
				<div class="input-field col m4 s12 form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
					<label for="slug">{{ trans('global.permission.fields.slug') }}*</label>
					<input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($permission) ? $permission->slug : '') }}">
					@if($errors->has('slug'))
						<p class="help-block">
							{{ $errors->first('slug') }}
						</p>
					@endif

				</div>
            </div>
            <div>
                <input class="waves-effect waves-light btn gradient-45deg-amber-amber z-depth-4 mr-1 mb-2" type="submit" value="{{ trans('global.Edit') }}">
            </div>
        </form>
        </div>
    </div>
</div>	   
@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection