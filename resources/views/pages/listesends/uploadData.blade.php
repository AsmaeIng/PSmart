{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Liste Sends')

{{-- main page content --}}
@section('content')

<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Listesends')</h4>

          <form action="{{ route('listesends.upload',$listesends->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<input id="name" type="text" name="name" value="{{ $listesends->name }}"  placeholder="name">
						<label for="name">@lang('locale.Name')</label>
					</div> 
					<div class="input-field col m3 s6">
						<select id="country_id" name="country_id">
								<option value=""></option>
								@foreach($country as $count)								
									@if (@$listesends->country_id===$count->id)
									<option id="{{ $count->id }}" name="{{ $count->id }}" value="{{$count->id}}" selected>{{$count->sortname}}</option>
									@else
									<option id="{{ $count->id }}" name="{{ $count->id }}" value="{{$count->id}}" >{{$count->sortname}}</option>
									@endif
								@endforeach
								
						</select>
						<label for="PlateformSponsor">@lang('locale.country')</label>
					</div>
					<div class="input-field col m3 s6">
						<select id="typeListe_id" name="typeListe_id">
									<option value=""></option>
								@foreach($typeliste as $type)
									@if (@$listesends->typeListe_id===$type->id)
									<option id="{{ $type->id }}" name="{{ $type->id }}" value="{{$type->id}}" selected>{{$type->name}}</option>
									@else
									<option id="{{ $type->id }}" name="{{ $type->id }}" value="{{$type->id}}" >{{$type->name}}</option>
									@endif
								@endforeach
								
						</select>
						<label for="PlateformSponsor">@lang('locale.Typeliste')</label>
					</div>
					<div class="input-field col m3 s6">
							<select id="isp_id" name="isp_id">
								<option value=""></option>
								@foreach($isps as $isp)							
									@if (@$listesends->isp_id===$isp->id)
										<option id="{{ $isp->id }}" name="{{ $isp->id }}" value="{{$isp->id}}" selected>{{$isp->name}}</option>
									@else
										<option id="{{ $isp->id }}" name="{{ $isp->id }}" value="{{$isp->id}}" >{{$isp->name}}</option>
									@endif
								@endforeach
							</select>
							<label for="PlateformSponsor">@lang('locale.isps')</label>
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
							@if($listesends->withMessageID == 'on')
								<input id="withMessageID"id="withMessageID" name="withMessageID" type="checkbox" checked="checked" />
							@elseif($listesends->withMessageID ==NULL)
								<input id="withMessageID" name="withMessageID" type="checkbox"  /> 
							@endif
								<span>@lang('locale.withMessageID')</span>
						</label>
                	</div>
					<div class="input-field col m3 s12">            
						<label>
							@if($listesends->active == 'on')
								<input id="active" name="active" type="checkbox" checked="checked" />
							@elseif($listesends->active ==NULL)
								<input id="active" name="active" type="checkbox"  />
							@endif
								<span>@lang('locale.IsActive')</span>
						</label>
					</div>					
					<div class="input-field col m3 s12">            
						<label>
							@if($listesends->optIn == 'on')
								<input id="optIn" name="optIn" type="checkbox" checked="checked" />
							@elseif($listesends->optIn ==NULL)
								<input id="optIn" name="optIn" type="checkbox"  />
							@endif
								<span>@lang('locale.optIn')</span>
						</label>
                	</div>
					
			
           		</div>
				   @if($listesends->optIn == 'on')
				    <div class="row" id="madiv" style="display:block">				
					<div class="input-field col m3 s6">
						<select id="delimiter" name="delimiter">																		
							<option value=""></option>														
								@if (@$listesends->delimiter==="/")
                       				<option id="" name="delimiter" value="/" selected>/</option>
    				            @else
                        			<option id="" name="delimiter" value="/" >/</option>
                    			@endif
								@if (@$listesends->delimiter===",")
                       				<option id="" name="delimiter" value="," selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value="," >,</option>
                    			@endif
								@if (@$listesends->delimiter==="|")
                       				<option id="" name="delimiter" value="|" selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value="|" >,</option>
                    			@endif
								@if (@$listesends->delimiter===";")
                       				<option id="" name="delimiter" value=";" selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value=";" >,</option>
                    			@endif
						</select>
						<label for="Delimiter">@lang('locale.Delimiter')</label>
					</div>
						
					<div class="input-field col m3 s6"  >
						<input id="firstname" type="text" name="firstname" value="{{ $listesends->firstname }}"  >
					
						<label for="firstname">@lang('locale.FirstName')</label>						
					</div>	
					<div class="input-field col m3 s6"  >
						<input id="lastname" type="text" name="lastname"  value="{{ $listesends->lastname }}" >
						<label for="lastname">@lang('locale.LastName')</label>						
					</div>	
					<div class="input-field col m3 s6"   >
						<input id="email" type="text" name="email"  value="{{ $listesends->email }}">
						<label for="email">@lang('locale.Email')</label>						
					</div>	
				</div>	
				@endif
				<div class="row" id="madiv" style="display:none">				
					<div class="input-field col m3 s6">
						<select id="delimiter" name="delimiter">																		
							<option value=""></option>														
								@if (@$listesends->delimiter==="/")
                       				<option id="" name="delimiter" value="/" selected>/</option>
    				            @else
                        			<option id="" name="delimiter" value="/" >/</option>
                    			@endif
								@if (@$listesends->delimiter===",")
                       				<option id="" name="delimiter" value="," selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value="," >,</option>
                    			@endif
								@if (@$listesends->delimiter==="|")
                       				<option id="" name="delimiter" value="|" selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value="|" >,</option>
                    			@endif
								@if (@$listesends->delimiter===";")
                       				<option id="" name="delimiter" value=";" selected>,</option>
    				            @else
                        			<option id="" name="delimiter" value=";" >,</option>
                    			@endif
						</select>
						<label for="Delimiter">@lang('locale.Delimiter')</label>
					</div>
						
					<div class="input-field col m3 s6"  >
						<input id="firstname" type="text" name="firstname" value="{{ $listesends->firstname }}">
					
						<label for="firstname">@lang('locale.FirstName')</label>						
					</div>	
					<div class="input-field col m3 s6"  >
						<input id="lastname" type="text" name="lastname"  value="{{ $listesends->lastname }}">
						<label for="lastname">@lang('locale.LastName')</label>						
					</div>	
					<div class="input-field col m3 s6"   >
						<input id="email" type="text" name="email"  value="{{ $listesends->email }}">
						<label for="email">@lang('locale.Email')</label>						
					</div>	
				</div>	

              	<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('isps.index') }}"></a> @lang('locale.Retour')
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
                $("#madiv").show();
            } else {
                $("#madiv").hide();
            }
        });
    });
</script>
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection