{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Reporting Tool')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.ReportingTool')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.ReportingTool')</h4>
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
          <form action="{{ route('reportings.update',$reportintools->id) }}" method="POST">
		  @csrf
		  @method('PUT')
				<div class="row">             
				  <div class="input-field col m6 s12">
						<select id="id_isps" name="id_isps">
							@foreach($data as $is)
								<option id="{{ $is->idIS }}" name="{{ $is->idIS }}" value="{{ $is->idIS }}" disabled selected>{{$is->nameIS}}</option>
							@endforeach
							@foreach($isps as $isp)							
								<option id="{{ $isp->id }}" name="{{ $isp->id }}" value="{{ $isp->id }}">{{$isp->name}}</option>
							@endforeach
						</select>
				  </div>
				  <div class="input-field col m6 s12">
					<input type="text" id="NumberReportl" name="NumberReportl" value="{{ $reportintools->NumberReportl }}" placeholder="">
					<label for="NumberReportl">@lang('locale.NumberSeeds')</label>
				  </div>     
				</div>
				<div class="row">             
					<div class="input-field col m3 s12">
						<label>
							@if($reportintools->spam == 'on')
							<input id="spam" name="spam" type="checkbox" checked="checked" />						
							@elseif($reportintools->spam =='NULL' or $reportintools->spam =='')
							<input id="spam" name="spam" type="checkbox"/>						
							@endif
							<span >IS Spam</span>
						</label>
					</div>
					<div class="input-field col m3 s12">
						<label>
							@if($reportintools->toindex == 'on')
							<input id="toindex" name="toindex" type="checkbox" checked="checked" />
							@elseif($reportintools->toindex =='NULL' or $reportintools->toindex =='')
							<input id="toindex" name="toindex" type="checkbox"/>
							@endif 
							<span>Is Index</span>
						</label>
					</div>
					<div class="input-field col m3 s12">
						<label>
							@if($reportintools->move == 'on')
							<input id="move" name="move" type="checkbox" checked="checked" />
							@elseif($reportintools->move =='NULL' or $reportintools->move =='')
							<input id="move" name="move" type="checkbox"/>						
							@endif
							<span>Move</span>
						</label>
					</div>
					<div class="input-field col m3 s12">
						<label>
							@if($reportintools->mark == 'on')
								<input id="mark" name="mark" type="checkbox" checked="checked" />
							@elseif($reportintools->mark =='NULL' or $reportintools->mark =='')
								<input id="mark" name="mark" type="checkbox"  />
							@endif
							<span>@lang('locale.IsMark')</span>
						</label>
					</div>
				</div>
				<div class="row" style="padding-top:35px;">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('reportings.index') }}"></a> @lang('locale.Retour')
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