
{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Liste Sends')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Listesends')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.AddNewListSends')</h4>		
			<form method="POST" action="{{ route('listesends.store') }}" enctype="multipart/form-data">
			  @csrf
				<div class="row">
					<div class="input-field col m3 s12">
						<input id="name" type="text" name="name">
						<label for="name">@lang('locale.Name')</label>
					</div>
					<div class="input-field col m3 s12">
						<select id="country_id" name="country_id">
							@foreach($country as $count)							
								<option id="{{ $count->id }}" value="{{ $count->id }}">{{ $count->name }}</option>
							@endforeach
							</select>
						<label for="country">@lang('locale.country')</label>
					</div>				  
					<div class="input-field col m3 s12">
						<select id="typeListe_id" name="typeListe_id">
							@foreach($typeliste as $typel)							
								<option id="{{ $typel->id }}" value="{{ $typel->id }}">{{ $typel->name }}</option>
							@endforeach
							</select>
						<label for="typeliste">@lang('locale.Typeliste')</label>
					</div>
					<div class="input-field col m3 s12">
						<select id="isp_id" name="isp_id">
							@foreach($isps as $isp)							
								<option id="{{ $isp->id }}" value="{{ $isp->id }}">{{ $isp->name }}</option>
							@endforeach
							</select>
						<label for="isps">@lang('locale.isps')</label>
					</div>
					
				</div>	
			
				<div class="row">	
					<div class="input-field col m3 s12">
						<div class="file-field input-field" >
							<div class="waves-effect waves-light btn gradient-45deg-red-pink z-depth-4 mr-1 mb-2" style="height: 2rem;line-height: 2rem;">
								<span>@lang('locale.Liste')</span>
								<input type="file" name="listeemail"  accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
							</div>
							<div class="file-path-wrapper">
									<input class="file-path validate" style="height: 2rem;" id="listeemail" name="listeemail" type="text" placeholder="Upload one or more files">
							</div>
						</div>
					</div>
					<div class="input-field col m3 s12">
						 <label>
							<input id="active" name="active" type="checkbox" checked="checked" />
							<span>@lang('locale.IsActive')</span>
						  </label>
					</div>
					<div class="input-field col m3 s12">
						 <label>
							<input id="withMessageID" name="withMessageID" type="checkbox" checked="checked" />
							<span>@lang('locale.withMessageID')</span>
						  </label>
					</div>
					<div class="input-field col m3 s12">
						 <label for="optIn">
						 <input id="optIn"  name="optIn" type="checkbox" checked="checked" />
							<span>@lang('locale.optIn')</span>
						  </label>
					</div>
												
				</div> 
				
				<div class="row" id="bloc" style="display:bloc;">
				
					<div class="input-field col m3 s12">
						<select id="delimiter" name="delimiter">											
								<option id="" value="/">/</option>	
								<option id="" value=",">,</option>
								<option id="" value="|">|</option>
								<option id="" value=";">;</option>					
							</select>
						<label for="Delimiter">@lang('locale.Delimiter')</label>
					</div>
						
					<div class="input-field col m3 s12"  >
						<input id="firstname" type="text" name="firstname" >
						<label for="firstname">@lang('locale.FirstName')</label>						
					</div>	
					<div class="input-field col m3 s12"  >
						<input id="lastname" type="text" name="lastname" >
						<label for="lastname">@lang('locale.LastName')</label>						
					</div>	
					<div class="input-field col m3 s12"   >
						<input id="email" type="text" name="email"  >
						<label for="email">@lang('locale.Email')</label>						
					</div>	
				</div>
				
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Add')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('listesends.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

@endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#optIn").click(function () {
            if ($(this).is(":checked")) {
                $("#bloc").show();
            } else {
                $("#bloc").hide();
            }
        });
    });
</script>

{{-- vendor scripts --}}
@section('vendor-script')

@endsection