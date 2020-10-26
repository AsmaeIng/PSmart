{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Drop')
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/noUiSlider/nouislider.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/magnific-popup/magnific-popup.css')}}">
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
          	<h4 class="card-title">@lang('locale.NewDrop')</h4>
				<form method="POST" action="" enctype="multipart/form-data" >
			  		@csrf
						<nav class="gradient-45deg-purple-deep-orange gradient-shadow">
							<div class="nav-wrapper" style="height:60px;">
								<ul id="nav-mobile" class="left hide-on-med-and-down">
									<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
									<li>@lang('locale.Network/Offer/ISP/Country')</li>          
								</ul>       
							</div>
						</nav>
						<div class="row" id="loading" style="display: none;">
							<CENTER>								
								<div class="preloader-wrapper big active">
									<div class="spinner-layer spinner-blue-only">
										<div class="circle-clipper left">
											<div class="circle"></div>
										</div>
										<div class="gap-patch">
											<div class="circle"></div>
										</div>
										<div class="circle-clipper right">
											<div class="circle"></div>
										</div>
									</div>
								</div>								
							</CENTER>
						</div>
						<div class="row">					
							<div class="col s12" id="information">
								<!-- users edit Info form start -->
								<!--<form id="infotabForm">-->
									<div class="row">
										<div class="col s12 m6">
											<div class="row">
												<div class="col s12 input-field">
													<h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
												</div>
												<div class="col s12 input-field ">
													<h6 class="card-title">@lang('locale.Network')</h6>
													<select class="browser-default" name="network_id" id="network_id">
													  <option value="0" disable="true" selected="true"> Select networks </option>
														@foreach ($networks as $key => $value)
														  <option value="{{$value->id}}">{{ $value->name }}</option>
														@endforeach
													</select>
													<!--<label for="Network">@lang('locale.Network')</label>--> 
												</div>
												<div class="col s12 input-field">
													<h6 class="card-title">@lang('locale.Offer')</h6>
													<select class="browser-default" name="offre_id" id="offre_id">
														<option value="0" disable="true" selected="true"> Select offres </option>
													</select>
													<!--<label for="Offer">@lang('locale.Offer')</label>  -->               
												</div>								
												<div class="col s12 input-field"> 
													<h6 class="card-title">@lang('locale.ISP')</h6>
													<select  id="id_isps" name="id_isps">
														<option value="-1">Please select ISP</option>
														 @foreach($isp as $is)							
															<option id="{{ $is->id }}" value="{{ $is->id }}">{{ $is->name}}</option>
														@endforeach 
													</select>
												</div>
																						
												<div class="col s12 input-field">
													<div>
														<h6 class="card-title">@lang('locale.EmailTest') </h6>                                   
														<textarea class="form-control" id="emailTest"  rows="5" name="emailTest" placeholder="" oninput="changedValue()" style="width:100%; height:100px;"></textarea>
														</br>  
														</br>
													</div>  
													<div>
														<label for="returnpath">@lang('locale.ReturnPath')</label> </br>
														<input placeholder="" id="returnpath" type="text" class="validate" value="return@[domain]">														
													</div>                                
												</div> 																
											</div>
										
										</div>
										<div class="col s12 m6">
											<div class="carousel carousel-slider center carousel-indicators" data-indicators="true" id="file_id">

											</div>
										</div>
										<input type="hidden" name="idCreative" id="idCreative"/>
							</div>
								<!--</form>-->
								<!-- users edit Info form ends -->
							</div>	
						</div>
						<nav class="gradient-45deg-purple-deep-orange gradient-shadow">
							<div class="nav-wrapper" style="height:60px;">
								<ul id="nav-mobile" class="left hide-on-med-and-down">
									<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
									<li>Server/IP :</li>          
								</ul>       
							</div>
						</nav>
						<div class="row">
							<div class="input-field col m12 s12">
								<div class="form-group">
									<div class="col m6 s12">
										<div class="form-group">
											<h6 class="card-title">@lang('locale.Server')</h6>
											<select name="server_id[]" id="server_id" multiple="multiple" size="250">
												@foreach ($servers as $key => $value)
													<option value="{{$value->id}}">{{ $value->alias }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col m6 s12">
										<div class="form-group">
											<h6 class="card-title">@lang('locale.VMTA')</h6>
											<select class="browser-default" name="ip_id[]" id="ip_id" multiple="multiple" size="250">
												<option value="0" disable="true" selected="true"> Select IP </option>
											</select>                        
										</div>
									</div>
								 </div>
							 </div> 
						</div>	
						<nav class="gradient-45deg-purple-deep-orange gradient-shadow">
							<div class="nav-wrapper" style="height:60px;">
								<ul id="nav-mobile" class="left hide-on-med-and-down">
									<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
									<li>@lang('locale.Body/Header') :</li>          
								</ul>       
							</div>
						</nav>
						<div class="row"> 
							<div class="input-field col m6 s12">
								<select id="headerss" name="header_id">
									<option value="0" disable="true" selected="true"> Select Header </option>
									@foreach($headers as $header)							
										<option id="{{ $header->id }}" value="{{ $header->id }}">{{ $header->name}}</option>
									@endforeach
								</select>
								<label for="headerss">@lang('locale.ChooseHeader')</label>
							</div>
							<div class="input-field col m6 s12">
								<select id="body" name="body_id">
								<option value="0" disable="true" selected="true"> Select Body </option>
									@foreach($bodys as $body)							
										<option id="{{ $body->id }}" value="{{ $body->id }}">{{ $body->name}}</option>
									@endforeach
								</select>
								<label for="body">@lang('locale.ChooseBody')</label>
							</div>
						</div>	
						<div class="row">   					
							<div class="input-field col m6 s12">
								<label for="headers">@lang('locale.Headerd')</label> </br>
								<div id="headers" style="padding-top:30px;padding-bottom:30px;"></div>																					
							</div>       					
							<div class="input-field col m6 s12">
								<label for="bodys"> @lang('locale.Bodyd')</label></br>
								<div  id="bodys" style="padding-top: 30px;padding-bottom: 30px;"></div>
							</div>       				   					
						</div>
						<div class="row">	
							<div class="input-field col s12">
								<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.CreatSend')
									<i class="material-icons right">send</i>
								</button>
								<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"   href="{{ route('drops.index') }}"> @lang('locale.Retour')
									<i class="material-icons right">keyboard_return</i>
								</a>
							</div>
						</div>										
				</form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$('#loading').hide();
$(document).on('change','#offre_id', function(){
	var offreID = $(this).val();
	$('#loading').show();	
	$.get
			(
				"/offres/SuppFile/"+offreID,				
				function(ajax_return)
				{
					console.log(ajax_return);
					alert(ajax_return);
					$('#loading').hide();
					//document.getElementById("bnt_create_send").disabled = false; 
				}
			);
});
</script>
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
        var network_id = e.currentTarget.value;
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
<script src="{{asset('vendors/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('js/scripts/media-gallery-page.js')}}"></script>
<script src="{{asset('js/scripts/form-elements.js')}}"></script>
<script src="{{asset('js/scripts/page-drops.js')}}"></script>
@endsection
