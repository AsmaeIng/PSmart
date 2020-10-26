{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Edit Drop')
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/noUiSlider/nouislider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">

@endsection
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Drops')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          	<h4 class="card-title">@lang('locale.EditDrop')</h4>
				<form method="POST" action="{{ route('drops.update',$drops->id) }}" >
			  		@csrf
					@method('PUT')
					  	<div class="card blue darken-1"style="height:60px;">
        					<div class="card-content white-text" >
          						<span class="">@lang('locale.Network/Offer/ISP/Country')</span>
          
        					</div>        
      					</div>
						<div class="row">					
							<div class="col s3 file-field input-field">			
								<select id="network_id" name="network_id">
									<option value=""></option>
									@foreach($networks as $net)	
										@if (@$drops->network_id===$net->id)						
										<option id="{{ $net->id }}" name="{{ $net->id }}" value="{{ $net->id }}"selected>{{ $net->name}}</option>
										@else
										<option id="{{ $net->id }}"name="{{ $net->id }}" value="{{ $net->id }}">{{ $net->name}}</option>
										@endif
									@endforeach
								</select>
								<label style="top: -26px;" for="Network">@lang('locale.Network')</label>							
							</div>
							<div class="col s3 file-field input-field">			
								<select class="browser-default" id="offre_id" name="offre_id">
									@foreach($offres as $off)
										@if (@$drops->offre_id===$off->id)								
										<option id="{{ $off->id }}" name="{{ $off->id }}" value="{{ $off->id }}" selected>{{ $off->name}}</option>
										@else
										@endif
									@endforeach
								</select>
								<label style="top: -26px;" for="Offer">@lang('locale.Offer')</label>
								
							</div>
							<div class="col s3 file-field input-field">			
								<select id="id_isps" name="id_isps">
									@foreach($isps as $is)		
										@if (@$drops->id_isps===$is->id)						
										<option id="{{ $is->id }}" name="{{ $is->id }}" value="{{ $is->id }}" selected>{{ $is->name}}</option>
										@else
										<option id="{{ $is->id }}" name="{{ $is->id }}" value="{{ $is->id }}" >{{ $is->name}}</option>
										@endif
									@endforeach
								</select>
								<label style="top: -26px;" for="ISP">@lang('locale.ISP')</label>
								
							</div>
							<div class="col s3 file-field input-field">			
								<select class="select2 browser-default" id="country" name="country_id">
									@foreach($country as $count)		
										@if (@$drops->country_id===$count->id)					
										<option id="{{ $count->id }}" name="{{ $count->id }}"value="{{ $count->id }}" selected>{{ $count->sortname}}</option>
										@else
										<option id="{{ $count->id }}" name="{{ $count->id }}"value="{{ $count->id }}" >{{ $count->sortname}}</option>
										@endif
									@endforeach
								</select>
								<label style="top: -26px;" for="Country">@lang('locale.Country')</label>							
							</div>
							<div class="col s12 input-field">
								<select class="select2 browser-default" name="listesends_id[]" id="listesends_id"  multiple="multiple">
									@foreach($drops->listesends as $id => $listesends)									
										<option value="{{ $id }}" selected {{ (in_array($id, old('listesends', [])) || isset($drops) && $drops->listesends->contains($id)) }}>
											{{ $listesends->name }}
										</option>
									@endforeach
								</select>
								<label style="top: -26px;" for="Country">@lang('locale.Liste')</label>
							</div>
							<div class="col s12 input-field">							
								<div class="carousel carousel-slider center carousel-indicators" data-indicators="true" id="file_id">
										@foreach($files as $of)
											@if (@$drops->file_id===$of->id)
												<div id="{{$of->id}}">
													<img src="/{{$of->path}}/{{$of->name}}" alt="{{$of->name}}-{{$of->id}}">
												</div>
											@endif
										@endforeach
								</div>
								<input type="hidden" name="idCreative" id="idCreative"/>
							</div>
						</div>
						<div class="card blue darken-1" style="height:60px;">
							<div class="card-content white-text">
								<span class="">Server/IP :</span>          
							</div>        
						</div>
						<div class="row">
							<div class="input-field col m12 s12">
								<div class="form-group">
									<div class="col m6 s12">
										<div class="form-group">
											<h6 class="card-title">@lang('locale.Server')</h6>
											<select name="server_id[]"  multiple="multiple" id="server_id" size="250">
												@foreach($drops->servers as $id => $servers)							
													<option id="{{ $servers->id }}" name="{{ $servers->id }}" value="{{ $servers->id }}" selected>{{ $servers->alias }}</option>
												@endforeach											
											</select>											
										</div>
									</div>
									<div class="col m6 s12">
										<div class="form-group">
											<h6 class="card-title">@lang('locale.VMTA')</h6>
											<select class="browser-default" name="ip_id[]" id="ip_id" multiple="multiple" size="250">  
												@foreach($drops->sips as $id => $sips)													
													<option id="{{ $sips->id }}" name="{{ $sips->id }}" value="{{ $sips->id }}" selected>{{$sips->IP}}</option>
												@endforeach
											</select>
												
												
										</div>
									</div>
								 </div>
							 </div> 
						</div>
						<div class="card blue darken-1" style="height:60px;">
							<div class="card-content white-text">
								<span class="">@lang('locale.Body/Header') :</span>          
							</div>        
						</div>	
						<div class="row">   					       						
							<div class="input-field col m6 s12">
								<label for="header">@lang('locale.Headerd')</label> </br>
								<select id="headerss" name="header_id">
									@foreach($headers as $header)		
										@if (@$drops->header_id===$header->id)
											<option id="{{ $header->id }}" value="{{ $header->id }}">{{ $header->name}}</option>
										@else
											<option id="{{ $header->id }}" value="{{ $header->id }}">{{ $header->name}}</option>
										@endif
									@endforeach
								</select>
							</div>       					
							<div class="input-field col m6 s12">
								<label for="body"> @lang('locale.Bodyd')</label> </br>
								<select id="body" name="body_id">
									@foreach($bodys as $body)		
										@if (@$drops->body_id===$body->id)
											<option id="{{ $body->id }}" value="{{ $body->id }}">{{ $body->name}}</option>
										@else
											<option id="{{ $body->id }}" value="{{ $body->id }}">{{ $body->name}}</option>
										@endif
									@endforeach
								</select>
							</div>       				    					
						</div>
						
						<div class="row">   					
							<div class="input-field col m6 s12">
									<label for="headers">@lang('locale.Headerd')</label> </br>
									<div id="headers" style="padding-top:30px;padding-bottom:30px;">
										@foreach($headers as $header)		
											@if (@$drops->header_id===$header->id)
												<textarea  class="materialize-textarea"  id="texte"  name="texte">{{ $header->texte}}</textarea>
											@endif
										@endforeach
									</div>																					
							</div>       					
							<div class="input-field col m6 s12">
								<label for="bodys"> @lang('locale.Bodyd')</label></br>
								<div  id="bodys" style="padding-top: 30px;padding-bottom: 30px;">
									@foreach($bodys as $body)		
										@if (@$drops->body_id===$body->id)
											<textarea  class="materialize-textarea"  id="texte"  name="texte">{{ $body->texte}}</textarea>
										@endif
									@endforeach
								</div>
							</div>       				   					
						</div>
						

						<div class="row">
							<div class="input-field col s12">
								<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
									<i class="material-icons right">send</i>
								</button>
								<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('drops.index') }}"></a> @lang('locale.Retour')
									<i class="material-icons right">keyboard_return</i>
								</button>
							</div>
						</div>
				</form>
        </div>
    </div>
</div>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
	var liste = null;
	const ids = [];
	var i = 0;
	
        $('#network_id').on('change', function(e){
        console.log(e);
        var network_id = e.target.value;
        $.get('/json-offres?network_id=' + network_id,function(data) {
          $('#offre_id').empty();
          $('#offre_id').append('<option value="0" disable="true" selected="true"> Select offres </option>');		 
          $('#file_id').empty();
          $.each(data, function(index, offresObj){
            $('#offre_id').append('<option value="'+ offresObj.id +'"  >'+ offresObj.name +'</option>');
          })
        });
      }); 
	  	$('#offre_id').on('change', function(e){
        console.log(e);
        var offre_id = e.target.value;
		$('#loading').show();	
		$.get
			("/offres/SuppFile/"+offre_id,function(ajax_return)
				{
					alert(ajax_return);
					$('#loading').hide();
				}
			);
        $.get('/json-files?offre_id=' + offre_id,function(data) {
          console.log(data);
          $('#file_id').empty();
          // $('#file_id').append('<ul class="slides"><li><img src="http://127.0.0.1:8000/images/offres/offre3.jpg/offre3.jpg"><div class="caption center-align"></div></li></ul>');

              $.each(data, function(index, filesObj){
				$('#file_id').append('<div class="carousel-item" onclick="myFunction('+filesObj.id+')" name="'+filesObj.id+'" id="'+filesObj.id+'" ><img  class="responsive-img mb-10" alt="" src="/'+filesObj.path+'/'+filesObj.name+'"></div>');					
				$(function () {
				  // Carousel
				  $('.carousel').carousel();
				  // Full Width Slider
				  $('.carousel.carousel-slider').carousel({ fullWidth: true });
				  // Special Options
				  $('.carousel.carousel-slider').carousel({ fullWidth: true });

				  $('.carousel.carousel-slider.carousel-indicators').carousel({
					fullWidth: true,
					indicators: true
				  });
				});												  
          })
        });
      });
			
	  $('#country').on('change', function(e){
        var country_id = e.target.value;
        $.get('/json-listesends?country_id=' + country_id,function(data) {        
        $('#listesends_id').empty();
		 // $('#listesends_id').append('<option value="0" disable="true" selected="true"> Select offres </option>');	
		// $('#listesends_id').append('<h6 class="card-title"> Select liste </h6>');			
        $.each(data, function(index, listesendsObj){
            $('#listesends_id').append('<option value="'+ listesendsObj.id +'" selected="true" >'+ listesendsObj.name +'</option>');
			
			// $('#listesends_id').append('<div class="col s4" ><label><input id="'+ listesendsObj.id +'" name="12" type="checkbox"/><span>'+ listesendsObj.name +'</span></label></div>'); 			
		  })
        });
      }); 
	 function myFunction(er) {
		document.getElementById("idCreative").value =er;
		console.log(document.getElementById("idCreative").value);
					 }
</script>
<script type="text/javascript">	  
	 $('#headerss').on('change', function(e){
        console.log(e);
        var header_id = e.target.value;
        $.get('/json-headers?header_id=' + header_id,function(data) {
          console.log(data);
          $('#headers').empty();
          $.each(data, function(index, headersObj){
			$('#headers').append('<textarea  class="materialize-textarea"  id="texte"  name="texte">'+ headersObj.texte +'</textarea>');
			 
          })
        });
      });
</script>
<script type="text/javascript">	  
	 $('#body').on('change', function(e){
        console.log(e);
        var body_id = e.target.value;
        $.get('/json-bodys?body_id=' + body_id,function(data) {
          console.log(data);
          $('#bodys').empty();
          $.each(data, function(index, bodysObj){
			$('#bodys').append('<textarea class="materialize-textarea" id="texte"  name="texte">'+ bodysObj.texte +'</textarea>');
			 
          })
        });
      });
</script>
<script type="text/javascript">  
	 $('#server_id').on('change', function(e){		
        const server_id=[];
		let selectedOption=(e.target.selectedOptions);
		for (let i = 0; i < selectedOption.length; i++){
			server_id.push(selectedOption.item(i).value);
			// alert(server_id);
			 // server_id = e.currentTarget.value;
				$.get('/json-ips?server_id=' + server_id,function(data) {
					$('#ip_id').empty();
					// $('#ip_id').append('<option value="0" disable="true" selected="true"> Select IP </option>');		 
					$.each(data, function(index, ipsObj){
						$('#ip_id').append('<option value="'+ ipsObj.id +'" selected="true" >'+ ipsObj.IP +'</option>');
					})
				});
		 }
      }); 
</script>
@endsection
{{-- vendor script --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
<script src="{{asset('vendors/magnific-popup/jquery.magnific-popup.min.js')}}"></script>


@endsection
{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/form-elements.js')}}"></script>
<script src="{{asset('js/scripts/page-drops.js')}}"></script>
@endsection