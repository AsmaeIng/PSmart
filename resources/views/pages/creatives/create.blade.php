{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Creative')
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
          <h4 class="card-title">@lang('locale.NewCreative')</h4>
			<form method="POST" action="{{ route('creatives.store') }}" >
			  @csrf
				<div class="row">
                    <div class="col s3 file-field input-field">			
							<select id="network_id" name="network_id">
								@foreach($network as $net)							
									<option id="{{ $net->id }}" value="{{ $net->id }}">{{ $net->name}}</option>
								@endforeach
							</select>
							<label for="Network">@lang('locale.Network')</label>
							
					</div>
					<div class="col s3 file-field input-field">			
							<select id="vertical_id" name="vertical_id">
								@foreach($vertical as $ver)							
									<option id="{{ $ver->id }}" value="{{ $ver->id }}">{{ $ver->name}}</option>
								@endforeach
							</select>
							<label for="vertical">@lang('locale.vertical')</label>
							
					</div>
					<div class="col s3 file-field input-field">			
							<select id="offer_id" name="offer_id">
								@foreach($offer as $off)							
									<option id="{{ $off->id }}" value="{{ $off->id }}">{{ $off->name}}</option>
								@endforeach
							</select>
							<label for="offer">@lang('locale.offer')</label>
							
					</div>			  
				</div>	
				<div class="row">					
					<div class="col m6 s12 file-field input-field">			
						<div class="float-right btn-floating mb-1 waves-effect waves-light gradient-45deg-orange-amber">
							<span><i class="material-icons">cloud_download</i></span>
							<input type="file">
						</div>
						<div class="file-path-wrapper">
							<i class="material-icons prefix">image</i>
							<input class="file-path validate" id="creative" name="creative" type="text">
						</div>
				
					</div>
					
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('creatives.index') }}"></a> @lang('locale.Retour')
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