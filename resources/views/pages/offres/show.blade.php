{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Offres')

{{-- main page content --}}
@section('content')
<script>
  use Carbon\Carbon;
</script>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/advance-ui-media.css')}}">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#downloadSuppression").click(function () {
            if ($(this).is(":checked")) {
                $("#myDIV").show();
            } else {
                $("#myDIV").hide();
            }
        })
		$("#isImage").click(function () {
            if ($(this).is(":checked")) {
                $("#myImg").show();
            } else {
                $("#myImg").hide();
            }
        })
    });
</script>

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top"></i>@lang('locale.Offre')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title"> @lang('locale.Offre')</h4>
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
        @foreach ($data as $offre)
				<div class="row">
					 <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="name">@lang('locale.Name') :<span class="red-text">*</span></label>
                    <input type="text" id="name" name="name"  value="{{ $offre->name}}" class="validate" required disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="lastName">SID<span class="red-text">*</span></label>
                    <input type="number" id="osid" class="validate" name="osid" value="{{ $offre->osid}}" required disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
                  </div>
                </div>
                <div class="row">
					<div class="input-field col m6 s12">
						<label for="froms">@lang('locale.froms') :<span class="red-text">*</span></label>
						<input type="text" class="validate" name="froms" id="froms" value="{{ $offre->froms}}" required disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
					</div>
					<div class="input-field col m6 s12">
						<i class="material-icons prefix">mode_edit</i>
						<textarea id="subjects" name="subjects" class="materialize-textarea" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">{{ $offre->subjects}}</textarea>
						<label for="subjects">@lang('locale.subjects') :</label>
					</div>
                </div>
				 <div class="row">
                  <div class="input-field col m6 s12">
						<select id="network_id" name="network_id">
							@foreach($data as $netw)
								<option id="{{ $netw->idNet }}" name="{{ $netw->idNet }}" value="{{ $netw->idNet }}" disabled selected>{{$netw->nameNet}}</option>
							@endforeach
						</select>			
						<label for="network_id">@lang('locale.network')  </label>
                  </div>
                  <div class="input-field col m6 s12">
						<select id="vertical_id" name="vertical_id">
							@foreach($data as $vert)
								<option id="{{ $vert->idVer }}" name="{{ $vert->idVer }}" value="{{ $vert->idVer }}" disabled selected>{{$vert->vertical}}</option>
							@endforeach
						</select>			
						<label for="vertical_id">@lang('locale.vertical')  </label>
                  </div>
                </div>
				<div class="row">
                  <div class="input-field col m6 s12">
                    <select id="country_id" name="country_id">
							@foreach($data as $count)
								<option id="{{ $count->idCon }}" name="{{ $count->idCon }}" value="{{ $count->idCon }}" disabled selected>{{$count->NameCon}}</option>
							@endforeach							
						</select>			
						<label for="country_id">@lang('locale.country')  </label>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="olink">@lang('locale.link'):</label>
                    <input type="text" class="validate" id="olink" name="olink" value="{{ $offre->olink}}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="unsub">@lang('locale.unsub'): <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="unsub" name="unsub" value="{{ $offre->unsub}}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
                  </div>
                  <div class="input-field col m3 s6">
                    <label>
						@if($offre->active == 'on')
							<input id="active" name="active" type="checkbox" checked="checked" />
						@elseif($offre->active =='NULL' or $offre->active =='')
							<input id="active" name="active" type="checkbox"  />
						@endif
						<span>@lang('locale.IsActive')</span>
					</label>
                  </div>
				  <div class="input-field col m3 s6">
                    <label>
						<input id="" name="sensitiv" type="checkbox" checked="checked" />
						<span></span>
					</label>
					<label>
						@if($offre->sensitiv == 'on')
							<input id="sensitiv" name="sensitiv" type="checkbox" checked="checked" />
						@elseif($offre->sensitiv =='NULL' or $offre->sensitiv =='')
							<input id="sensitiv" name="sensitiv" type="checkbox"  />
						@endif
						<span>@lang('locale.IsSensitive')</span>
					</label>
                  </div>
                </div>
				
				<div class="row">
                  <div class="input-field col m6 s12">
                    <span>@lang('locale.Downloadsuppressionfilemanually')</span>
					<div class="switch">
						<label>
						  Off
						  @if($offre->downloadSuppression == 'off')
							<input id="downloadSuppression" name="downloadSuppression" onclick="myFunction()" type="checkbox">
							@elseif($offre->downloadSuppression == 'on')
							  <input id="downloadSuppression" name="downloadSuppression" type="checkbox" onclick="myFunction()" checked="checked">
							@endif
						  <span class="lever"></span>
						  On
						</label>
					</div>
                  </div>
				  <div class="input-field col m6 s12">
						<select id="notWorkingDays" name="notWorkingDays[]" multiple="multiple" size="80">		
						
							
							@if(strpos($offre->notWorkingDays, 'Monday') !== false)
							<option value="Monday" disabled selected >@lang('locale.Monday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Tuesday') !== false)					
							<option value="Tuesday" disabled selected >@lang('locale.Tuesday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Wednesday') !== false)
							<option value="Wednesday" disabled selected >@lang('locale.Wednesday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Thursday') !== false)
							<option value="Thursday" disabled selected >@lang('locale.Thursday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Friday') !== false)
							<option value="Friday" disabled selected >@lang('locale.Friday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Saturday') !== false)
							<option value="Saturday" disabled selected >@lang('locale.Saturday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Sunday') !== false)
							<option value="Sunday" disabled selected >@lang('locale.Sunday')</option>
							@endif
						</select>
						<label>@lang('locale.NotWorkingDays')</label>
                  </div>                  
                </div>
				@if($offre->downloadSuppression == 'on')
					<div class="row"  id="myDIV">
						<div class="input-field col m6 s12">
							<label>
								<input id="TreatSuppression" name="TreatSuppression"  value="{{ $offre->TreatSuppression}}" type="checkbox" checked="checked" />
								<span>@lang('locale.DontTreatSuppression')</span>
							</label>
						</div>
						<div class="input-field col m6 s12">
							<select id="TypeSuppression" name="TypeSuppression">
								@if($offre->TypeSuppression == '1')
									<option  disabled selected>Text</option>
								@elseif($offre->TypeSuppression =='2')
									<option  disabled selected>MD5</option>
								@endif
							</select>
							<label>@lang('locale.TypeSuppression')</label>
						</div>
						<div class="input-field col m6 s12">											
							<div >
								<ul >
								  @foreach($suppressions as $sup)	  
								 <li >						
									<a href="/{{$sup->path}}/{{$sup->name}}">{{$sup->name}}</a>
									<div class="caption center-align">						  
									</div>
								  </li>
								  @endforeach
								</ul>
							</div>
						</div>
						
						<div class="input-field col m6 s12">
							<label for="DirectLink">@lang('locale.DirectlinkofSuppressionfile') : <span class="red-text">*</span></label>
							<input type="text" class="validate" id="DirectLink" name="DirectLink" value="{{ $offre->DirectLink}}" disabled="true" style="color: #000;border-bottom: 1px solid #9e9e9e;border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: rgb(158, 158, 158);">
						</div>
					</div>
				@endif
				<div class="row">				  
					<div class="input-field col m6 s12">
						<span>Image</span>
						<div class="switch">
						<label>
						  Off
						  @if ($offre->isImage == 'on')
							  <input id="isImage" name="isImage"   type="checkbox" checked="checked">
							
							@elseif ($offre->isImage == 'Null' or $offre->isImage == '')
							  <input id="isImage" name="isImage" type="checkbox">
							@endif
						  <span class="lever"></span>
						  On
						</label>
					</div>
					</div>
					@if($offre->isImage == 'on')
					<div class="input-field col m6 s12" id="myImg">					
						<div class="slider" >
							<ul class="slides">
							  @foreach($files as $of)	  
							 <li>						
								<img src="/{{$of->path}}/{{$of->name}}">
								<div class="caption center-align">						  
								</div>
							  </li>
							  @endforeach
							</ul>
						</div>
					</div>
					@endif
                </div>
				<div class="row">
					<div class="input-field col s12">
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left" href="{{ route('offres.index') }}"> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </a>
					</div>
											
				</div>
            </div>
          @endforeach
        </div>
    </div>
</div>	 

<!--<iframe  width="100%" height="100%" src="https://b2directpartners.com/affiliates/api/Offers/OfferStatuses?api_key=Oy7vrVykyoIV0x0xWXzxxw&affiliate_id=701080">
						</iframe>-->
  
@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection