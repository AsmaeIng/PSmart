{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Offres')
{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/advance-ui-media.css')}}">
@endsection
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Offre')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Offre')</h4>
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
          <form action="{{ route('offres.update',$offre->id) }}" method="POST"  enctype="multipart/form-data">
			@csrf
		
				<div class="row">
                  <div class="input-field col m3 s12">
						<label for="name">@lang('locale.Name') :<span class="red-text">*</span></label>
						<input type="text" id="name" name="name"  value="{{ $offre->name}}" class="validate" required>
					</div>
					<div class="input-field col m3 s12">
						<label for="lastName">SID<span class="red-text">*</span></label>
						<input type="number" id="osid" class="validate" name="osid" value="{{ $offre->osid}}" required>
					</div>
					<div class="input-field col m3 s12">
						<label for="froms">@lang('locale.froms') :<span class="red-text">*</span></label>
						<input type="text" class="validate" name="froms" id="froms" value="{{ $offre->froms}}" required>
					</div>
					<div class="input-field col m3 s12">
							<select id="vertical_id" name="vertical_id">
								@foreach($verticals as $vertical)	
									@if (@$offre->vertical_id===$vertical->id)						
										<option id="{{ $vertical->id }}" name="{{ $vertical->id }}" value="{{ $vertical->id }}">{{ $vertical->name}}</option>
									@else
										<option id="{{ $vertical->id }}" name="{{ $vertical->id }}" value="{{ $vertical->id }}">{{ $vertical->name}}</option>
									@endif
								@endforeach
							</select>			
							<label for="vertical_id">@lang('locale.vertical')  </label>
					</div>
					
                </div>
                <div class="row">
					<div class="input-field col m3 s12">
						<select id="network_id" name="network_id">							
							@foreach($networks as $net)		
								@if (@$offre->network_id===$net->id)						
									<option id="{{ $net->id }}" name="{{ $net->id }}" value="{{ $net->id }}" selected>{{ $net->name}}</option>
								@else
									<option id="{{ $net->id }}"name="{{ $net->id }}" value="{{ $net->id }}">{{ $net->name}}</option>
								@endif
							@endforeach
						</select>			
						<label for="network_id">@lang('locale.network')  </label>
					</div>
					 <div class="input-field col m3 s12">
						<select id="country_id" name="country_id">							
							@foreach($countrys as $country)		
								@if (@$country->id===$offre->country_id)						
									<option id="{{ $country->id }}" name="{{ $country->id }}" value="{{ $country->id }}" selected>{{ $country->sortname}}</option>
								@else
									<option id="{{ $country->id }}" name="{{ $country->id }}" value="{{ $country->id }}">{{ $country->sortname}}</option>
								@endif
							@endforeach
						</select>			
						<label for="country_id">@lang('locale.country')  </label>
					</div>
					<div class="input-field col m3 s12">
						<label for="olink">@lang('locale.link'):</label>
						<input type="text" class="validate" id="olink" name="olink" value="{{ $offre->olink}}">
					</div>
					<div class="input-field col m3 s12">
						<label for="unsub">@lang('locale.unsub'): <span class="red-text">*</span></label>
						<input type="text" class="validate" id="unsub" name="unsub" value="{{ $offre->unsub}}">
					</div>					
                </div>				
                <div class="row">
                  <div class="input-field col m6 s12">
						<i class="material-icons prefix">mode_edit</i>
						<textarea id="subjects" name="subjects" class="materialize-textarea">{{ $offre->subjects}}</textarea>
						<label for="subjects">@lang('locale.subjects') :</label>
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
						  @if ($offre->downloadSuppression == 'on')
							  <input id="downloadSuppression" name="downloadSuppression"   type="checkbox" checked="checked">
							
							@elseif ($offre->downloadSuppression == 'Null' or $offre->downloadSuppression == '')
							  <input id="downloadSuppression" name="downloadSuppression" type="checkbox">
							@endif
						  <span class="lever"></span>
						  On
						</label>

					</div>
                  </div>
				  <div class="input-field col m6 s12">
						<select id="notWorkingDays" name="notWorkingDays[]" multiple="multiple" size="80">		
						
							
							@if(strpos($offre->notWorkingDays, 'Monday') !== false)
							<option value="Monday"  selected >@lang('locale.Monday')</option>
							@else
							<option value="Monday" >@lang('locale.Monday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Tuesday') !== false)					
							<option value="Tuesday"  selected >@lang('locale.Tuesday')</option>
							@else
							<option value="Tuesday"  >@lang('locale.Tuesday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Wednesday') !== false)
							<option value="Wednesday"  selected >@lang('locale.Wednesday')</option>
							@else
							<option value="Wednesday" >@lang('locale.Wednesday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Thursday') !== false)
							<option value="Thursday"  selected >@lang('locale.Thursday')</option>
							@else
							<option value="Thursday"  >@lang('locale.Thursday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Friday') !== false)
							<option value="Friday"  selected >@lang('locale.Friday')</option>
							@else
							<option value="Friday"  >@lang('locale.Friday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Saturday') !== false)
							<option value="Saturday"  selected >@lang('locale.Saturday')</option>
							@else
							<option value="Saturday"  >@lang('locale.Saturday')</option>
							@endif
							@if(strpos($offre->notWorkingDays, 'Sunday') !== false)
							<option value="Sunday"  selected >@lang('locale.Sunday')</option>
							@else
							<option value="Sunday" >@lang('locale.Sunday')</option>
							@endif
						</select>
						<label>@lang('locale.NotWorkingDays')</label>
                  </div>                  
                </div>
				@if($offre->downloadSuppression == 'on')
					<div class="row"  id="myDIV">
						<div class="input-field col m6 s12">
							<div class="file-field input-field">
								<div class="waves-effect waves-light btn-small">
									<span>Suppression<i class="material-icons right">cloud</i></span>
									<input type="file" multiple>
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" style="height: 2rem;" id="Suppression" name="Suppression" value="{{$offre->Suppression }}" type="text" placeholder="Upload one or more files">
								</div>
							</div>
						</div>
						<div class="input-field col m6 s12">
							<label for="DirectLink">@lang('locale.DirectlinkofSuppressionfile') : <span class="red-text">*</span></label>
							<input type="text" class="validate" id="DirectLink" name="DirectLink" value="{{ $offre->DirectLink}}">
						</div>

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
								<option value="1">Text</option>
								<option value="2">MD5</option>
							</select>
							<label>@lang('locale.TypeSuppression')</label>
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
					<div class="col m6 s12" id="myImg">					
						<div class="slider">
							<ul class="slides mt-2">
							  @foreach($files as $of)	  
							 <li>						
								<img src="/{{$of->path}}/{{$of->name}}" alt="{{$of->name}}-{{$of->id}}">
							  </li>
							  @endforeach
							</ul>
						</div>											
						<div class="file-field input-field">
							<div class="waves-effect waves-light btn gradient-45deg-red-pink z-depth-4 mr-1 mb-2">
								<span>Images <i class="material-icons right">cloud</i></span>
								<input type="file" name="files[]" multiple accept="image/*">
							</div>
							<div class="file-path-wrapper">
								<input class="file-path validate" style="height: 2rem;" id="Creative" name="Creative" type="text" placeholder="Upload one or more files">
							</div>
						</div>
							@if ($errors->has('files'))
								@foreach ($errors->get('files') as $error)
								<span class="invalid-feedback" role="alert">
									<strong>{{ $error }}</strong>
								</span>
								@endforeach
							  @endif

					</div>
					@endif
                </div>
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					  </button>
					  <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left" href="{{ route('offres.index') }}"> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </a>
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
<script src="{{asset('js/scripts/advance-ui-media.js')}}"></script>
@endsection