{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Role')

{{-- main page content --}}
@section('content')

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
          <form action="{{ route('roles.update',$roles->id) }}" method="POST">
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
@endsection