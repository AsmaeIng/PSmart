{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Domain')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Domains')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.NewDomain')</h4>
			<form method="POST" action="{{ route('domains.store') }}" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="name" type="text" name="name">
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m3 s6">
						<input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" placeholder="sale Date" value="14/11/2019">
						<label for="icon_attach_money">@lang('locale.SaleDate')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker" placeholder="sale Date" value="14/11/2019">			
						<label for="icon_short_text">@lang('locale.ExpirationDate')  </label>
					</div>
					<div class="col s3 file-field input-field">			
						<select id="provider_id" name="provider_id">
							@foreach($provider as $prov)							
								<option id="{{ $prov->id }}" value="{{ $prov->id }}">{{ $prov->name}}</option>
							@endforeach
						</select>
						<label for="Provider">@lang('locale.Provider')</label>
							
					</div>
				</div>		
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"   href="{{ route('domains.index') }}"> @lang('locale.Retour')
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