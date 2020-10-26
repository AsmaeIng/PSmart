@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Offre')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/materialize-stepper/materialize-stepper.min.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-wizard.css')}}">
@endsection

{{-- page content --}}
<script>
  use Carbon\Carbon;
</script>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }}
</script>
<script>
function Afficher() {
  var x = document.getElementById("HTML");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }}
</script>

<style>
	#myDIV {
	  display: none;
	}
	#HTML {
	  display: none;
	}
	
</style>
@section('content')
<div class="section section-form-wizard" id="insertCode">
  <div class="card">
    <div class="card-content">
      <p class="caption mb-0"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.NewOffre')</p>
    </div>
  </div>

  <!-- Horizontal Stepper -->

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content pb-0">
          <div class="card-header mb-2">
            <h4 class="card-title">Horizontal Stepper</h4>
          </div>
			<form method="POST" action="{{ route('offres.store') }}" enctype="multipart/form-data">
			  @csrf
          <ul class="stepper horizontal" id="horizStepper">
            <li class="step active">
              <div class="step-title waves-effect">Step 1</div>
              <div class="step-content">
                 <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="name">@lang('locale.Name') :<span class="red-text">*</span></label>
                    <input type="text" id="name" name="name" class="validate" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="lastName">SID<span class="red-text">*</span></label>
                    <input type="number" id="osid" class="validate" name="osid" required>
                  </div>
                </div>
                <div class="row">
					<div class="input-field col m6 s12">
						<label for="froms">@lang('locale.froms') :<span class="red-text">*</span></label>
						<input type="text" class="validate" name="froms" id="froms" required>
					</div>
					<div class="input-field col m6 s12">
						<i class="material-icons prefix">mode_edit</i>
						<textarea id="subjects" name="subjects" class="materialize-textarea"></textarea>
						<label for="subjects">@lang('locale.subjects') :</label>
					</div>
                </div>
				 <div class="row">
                  <div class="input-field col m6 s12">
						<select id="network_id" name="network_id">
							@foreach($networks as $network)							
								<option id="{{ $network->id }}" value="{{ $network->id }}">{{ $network->name}}</option>
							@endforeach
						</select>			
						<label for="network_id">@lang('locale.network')  </label>
                  </div>
                  <div class="input-field col m6 s12">
						<select id="vertical_id" name="vertical_id">
							@foreach($verticals as $vertical)							
								<option id="{{ $vertical->id }}" value="{{ $vertical->id }}">{{ $vertical->name}}</option>
							@endforeach
						</select>			
						<label for="vertical_id">@lang('locale.vertical')  </label>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="btn btn-light previous-step" disabled>
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 2</div>
              <div class="step-content">
               
                <div class="row">
                  <div class="input-field col m4 s12">
                    <select id="country_id" name="country_id">
							@foreach($countrys as $country)							
								<option id="{{ $country->id }}" value="{{ $country->id }}">{{ $country->sortname}}</option>
							@endforeach
						</select>			
						<label for="country_id">@lang('locale.country')  </label>
                  </div>
                  <div class="input-field col m4 s12">
                    <label for="olink">@lang('locale.link'):</label>
                    <input type="text" class="validate" id="olink" name="olink"  required 
						onkeyup="document.getElementById('url').value=this.value;"  pattern="https://.*" size="30">
                  </div>
				  <div class="input-field col m4 s12">
                    <label for="unsub">@lang('locale.unsub'): <span class="red-text">*</span></label>
                    <input type="text" class="validate"   id="unsub" name="unsub">
                  </div>
                </div>
                <div class="row">
					<div class="input-field col m6 s12">					
						<div class="file-field input-field">
						  <div class="waves-effect waves-light btn gradient-45deg-red-pink z-depth-4 mr-1 mb-2">
							<span>Images <i class="material-icons right">cloud</i></span>
							<input type="file" name="files[]" multiple accept="image/*">
						  </div>
						  <div class="file-path-wrapper">
							<input class="file-path validate" style="height: 2.5rem;" id="Creative" name="Creative" type="text" placeholder="Upload one or more files">
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
					<div class="input-field col m2 s6">
							<label style="padding-top: 35;">
								<input id="active" name="active" type="checkbox" checked="checked" />
								<span>@lang('locale.IsActive')</span>
							</label>
					</div>
					<div class="input-field col m2 s6">
						<label style="padding-top: 35;">
							<input id="sensitiv" name="sensitiv" type="checkbox" checked="checked" />
							<span>@lang('locale.IsSensitive')</span>
						</label>
					</div>
					<div class="input-field col m2 s12">
						<span>Image</span>
						<div class="switch" style="padding-top: 35;">
							<label > Off <input id="isImage" name="isImage" type="checkbox"> <span class="lever"></span> On </label>
						</div>
					</div>
					
                </div>
				<!--<div class="row">
					<div class="col m2 s12">
						<div class="switch">
							<label> URL <input id="html" name="html" onclick="Afficher()" type="checkbox"><span class="lever"></span> HTML </label>
						</div>
					</div>
					<div class="input-field col m4 s12">									
						
						<iframe  width="80%" height="50px" src="{{ route('offres.createImage') }}">
						</iframe>
						<input placeholder="Enter your website's URL..." style="width: 50%;" name = "url" id="url" type="text">							
						<button id="btn-show-all-doc" onclick="myFunction1()" class="btn waves-effect waves-light gradient-45deg-indigo-light-blue "  type="button">
							@lang('locale.Envoyer')
						</button>
						
					</div>					
					<div class="input-field col m6 s12" id="HTML">
						<input placeholder="Placeholder" id="textarea2" type="text" class="validate">
						<label for="textarea2">Code Html</label>
					</div>					
                </div>-->
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 previous-step">
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 3</div>
              <div class="step-content">
               
                <div class="row">
                  <div class="input-field col m6 s12">
                    <span>@lang('locale.Downloadsuppressionfilemanually')</span>
					<div class="switch">
						<label>
						  Off
						  <input id="downloadSuppression" name="downloadSuppression" onclick="myFunction()" type="checkbox">
						  <span class="lever"></span>
						  On
						</label>
					</div>
                  </div>
				  <div class="input-field col m6 s12">
						<select id="notWorkingDays" name="notWorkingDays[]" multiple="multiple" size="7">
							<option value="Monday">@lang('locale.Monday')</option>
							<option value="Tuesday">@lang('locale.Tuesday')</option>
							<option value="Wednesday">@lang('locale.Wednesday')</option>
							<option value="Thursday">@lang('locale.Thursday')</option>
							<option value="Friday">@lang('locale.Friday')</option>
							<option value="Saturday">@lang('locale.Saturday')</option>
							<option value="Sunday">@lang('locale.Sunday')</option>
						</select>
						 <label>@lang('locale.NotWorkingDays')</label>
                  </div>                  
                </div>
					<div class="row"  id="myDIV">
						<div class="input-field col m6 s12">
							<div class="file-field input-field">
								  <div class="waves-effect waves-light btn-small">
									<span>Suppression <i class="material-icons right">cloud</i></span>
									<input type="file" name="suppressions[]" multiple accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
								  </div>
								  <div class="file-path-wrapper">
									<input class="file-path validate" style="height: 2.5rem;" id="suppression" name="suppression" type="text" placeholder="Upload one or more files">
								  </div>
							</div>
						</div>
						<div class="input-field col m6 s12">
							<label for="DirectLink">@lang('locale.DirectlinkofSuppressionfile') : <span class="red-text">*</span></label>
							<input type="text" class="validate" id="DirectLink" name="DirectLink">
						</div>

						<div class="input-field col m6 s12">
							<label style="padding-top:35px;">
								<input id="TreatSuppression" name="TreatSuppression" type="checkbox" checked="checked" />
								<span>@lang('locale.DontTreatSuppression')</span>
							</label>
						</div>
						<div class="input-field col m6 s12">
							<select id="TypeSuppression" name="TypeSuppression">
								<option value="1">Text</option>
								<option value="2">MD5</option>
							</select>
							<label>@lang('locale.TypeSuppression')</label>
					  </div>
                </div>

                <div class="step-actions">
                  <div class="row">
                    <div class="col m6 s12 mb-1">
                      <button class="red btn mr-1 btn-reset" type="reset">
                        <i class="material-icons">clear</i>
                        Reset
                      </button>
                    </div>
                    <div class="col m6 s12 mb-1">
                      <button class="waves-effect waves-dark btn btn-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
		  </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Linear Stepper -->

  <div class="row" style="display: none;">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="card-header">
            <h4 class="card-title">Linear Stepper</h4>
          </div>

          <ul class="stepper linear" id="linearStepper">
            <li class="step active">
              <div class="step-title waves-effect">Step 1</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="firstName12">First Name: <span class="red-text">*</span></label>
                    <input type="text" id="firstName12" name="firstName1" class="validate" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="lastName1">Last Name: <span class="red-text">*</span></label>
                    <input type="text" id="lastName1" class="validate" name="lastName1" required>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="Email2">Email: <span class="red-text">*</span></label>
                    <input type="email" class="validate" name="Email" id="Email2" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="contactNum2">Contact Number: <span class="red-text">*</span></label>
                    <input type="number" class="validate" name="contactNum" id="contactNum2" required>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 previous-step" disabled>
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 2</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="proposal1">Proposal Title: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="proposal1" name="proposal1" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="job1">Job Title: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="job1" name="job1" required>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="company12">Previous Company:</label>
                    <input type="text" class="validate" id="company12" name="company1">
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="url1">Video Url:</label>
                    <input type="url" class="validate" id="url1">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="exp1">Experience: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="exp1" name="exp1">
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="desc1">Short Description: <span class="red-text">*</span></label>
                    <textarea name="desc" id="desc1" rows="4" class="materialize-textarea"></textarea>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 previous-step">
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 3</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="eventName1">Event Name: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="eventName1" name="eventName1" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Select Event Type</option>
                      <option value="Wedding">Wedding</option>
                      <option value="Party">Party</option>
                      <option value="FundRaiser">Fund Raiser</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Select Event Status</option>
                      <option value="Planning">Planning</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Event Location</option>
                      <option value="New York">New York</option>
                      <option value="Queens">Queens</option>
                      <option value="Washington">Washington</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="Budget1">Event Budget: <span class="red-text">*</span></label>
                    <input type="Number" class="validate" id="Budget1" name="Budget1">
                  </div>
                  <div class="input-field col m6 s12">
                    <p> <label>Requirments</label></p>
                    <p> <label>
                        <input type="checkbox">
                        <span>Staffing</span>
                      </label></p>
                    <p><label>
                        <input type="checkbox">
                        <span>Catering</span>
                      </label></p>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m6 s12 mb-1">
                      <button class="red btn mr-1 btn-reset" type="reset">
                        <i class="material-icons">clear</i>
                        Reset
                      </button>
                    </div>
                    <div class="col m6 s12 mb-1">
                      <button class="waves-effect waves-dark btn btn-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Non Linear Stepper -->

  <div class="row"  style="display: none;" >
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="card-header">
            <h4 class="card-title">Non Linear Stepper</h4>
            <p>In the Non-Linear Stepper you can navigate freely between steps. You can also use the
              buttons for validation, but if the user wants to move arbitrarily around the steps, it's
              allowed by clicking on the steps instead of the buttons.</p>
          </div>

          <ul class="stepper" id="nonLinearStepper">
            <li class="step active">
              <div class="step-title waves-effect">Step 1</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="firstName1">First Name: <span class="red-text">*</span></label>
                    <input type="text" id="firstName1" name="firstName1" class="validate" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="lastName12">Last Name: <span class="red-text">*</span></label>
                    <input type="text" id="lastName12" class="validate" name="lastName1" required>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="Email">Email: <span class="red-text">*</span></label>
                    <input type="email" class="validate" name="Email" id="Email" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="contactNum">Contact Number: <span class="red-text">*</span></label>
                    <input type="number" class="validate" name="contactNum" id="contactNum" required>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="btn btn-light previous-step" disabled>
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 2</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="proposal12">Proposal Title: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="proposal12" name="proposal1" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="job12">Job Title: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="job12" name="job1" required>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="company1">Previous Company:</label>
                    <input type="text" class="validate" id="company1" name="company1">
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="url123">Video Url:</label>
                    <input type="url" class="validate" id="url123">
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="exp123">Experience: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="exp123" name="exp1">
                  </div>
                  <div class="input-field col m6 s12">
                    <label for="desc123">Short Description: <span class="red-text">*</span></label>
                    <textarea name="desc" id="desc123" rows="4" class="materialize-textarea"></textarea>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="btn btn-light previous-step">
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="step">
              <div class="step-title waves-effect">Step 3</div>
              <div class="step-content">
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="eventName123">Event Name: <span class="red-text">*</span></label>
                    <input type="text" class="validate" id="eventName123" name="eventName1" required>
                  </div>
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Select Event Type</option>
                      <option value="Wedding">Wedding</option>
                      <option value="Party">Party</option>
                      <option value="FundRaiser">Fund Raiser</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Select Event Status</option>
                      <option value="Planning">Planning</option>
                      <option value="In Progress">In Progress</option>
                      <option value="Completed">Completed</option>
                    </select>
                  </div>
                  <div class="input-field col m6 s12">
                    <select>
                      <option value="Select" disabled selected>Event Location</option>
                      <option value="New York">New York</option>
                      <option value="Queens">Queens</option>
                      <option value="Washington">Washington</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col m6 s12">
                    <label for="Budget123">Event Budget: <span class="red-text">*</span></label>
                    <input type="Number" class="validate" id="Budget123" name="Budget1">
                  </div>
                  <div class="input-field col m6 s12">
                    <p> <label>Requirments</label></p>
                    <p> <label>
                        <input type="checkbox">
                        <span>Staffing</span>
                      </label></p>
                    <p><label>
                        <input type="checkbox">
                        <span>Catering</span>
                      </label></p>
                  </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m6 s12 mb-1">
                      <button class="red btn mr-1 btn-reset" type="reset">
                        <i class="material-icons">clear</i>
                        Reset
                      </button>
                    </div>
                    <div class="col m6 s12 mb-1">
                      <button class="waves-effect waves-dark btn btn-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/form-wizard.js')}}"></script>
@endsection