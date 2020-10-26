{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Country')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Country')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Country')</h4>
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
          <form action="{{ route('countrys.update',$country->id) }}" method="POST" enctype="multipart/form-data">
		  @csrf
		  @method('PUT')
            <div class="row">
              <div class="input-field col m6 s12">
				<input type="text" id="first_name01" name="name" value="{{ $country->name }}" placeholder="name">
                <label for="first_name01">@lang('locale.Name')</label>
              </div>           
			  <div class="input-field col m6 s12">
				<input type="text" id="first_name01" name="sortname" value="{{ $country->sortname }}" placeholder="sortname">
                <label for="sortname">@lang('locale.Sortname')</label>
              </div> 
            </div> 
			<div class="row">
              <div class="input-field col m6 s12">
				<input type="text" id="first_name01" name="phonecode" value="{{ $country->phonecode }}" placeholder="name">
                <label for="phonecode">@lang('locale.Phonecode')</label>
              </div>           

             <div class="col m6 s12 file-field input-field">			
					<div class="waves-effect waves-light btn-small">
						<span>Logo <i class="material-icons right">cloud</i></span>
						<input type="file" name="logo" accept="image/*">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" id="logo" name="logo" type="text" placeholder="Upload one or more files">
					</div>			
				</div>
            </div>
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('countrys.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </button>
					</div>
											
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