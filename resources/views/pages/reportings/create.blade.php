{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Reporting Tool')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.ReportingTool')
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
			<form method="POST" action="{{ route('reportings.store') }}" >
			  @csrf
				<div class="row">
					<div class="input-field col m6 s6">
						<select id="id_isps" name="id_isps">
							@foreach($isps as $isp)							
								<option id="{{ $isp->id }}" value="{{ $isp->id }}">{{ $isp->name}}</option>
							@endforeach
						</select>			
						<label for="isps">@lang('locale.ListeISPS')  </label>
					</div>
					<div class="input-field col m6 s6">
						<input id="NumberReportl" type="text" name="NumberReportl"   placeholder="">
						<label for="NumberReportl">@lang('locale.NumberSeeds')</label>
					</div>			  
					
				</div>
				<div class="row">
					<div class="input-field col m3 s6">
						 <label>
							<input id="spam" name="spam" type="checkbox"/>
							<span>@lang('locale.MarkAsReadSpam')</span>
						  </label>
					</div>
					<div class="input-field col m3 s6">			
						<label>
							<input id="toindex" name="toindex" type="checkbox"/>
							<span>@lang('locale.MarkAsReadIndex')</span>
						  </label>
					</div>
					<div class="input-field col m3 s6">
						 <label>
							<input id="move" name="move" type="checkbox"/>
							<span>@lang('locale.Move')</span>
						  </label>
					</div>
					<div class="input-field col m3 s6">			
						<label>
							<input id="mark" name="mark" type="checkbox"/>
							<span>@lang('locale.MarkAsFlagged')</span>
						  </label>
					</div>
				</div>		
				<div class="row" style="padding-top:35px;">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.StartReporting')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('reportings.index') }}"></a> @lang('locale.Retour')
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