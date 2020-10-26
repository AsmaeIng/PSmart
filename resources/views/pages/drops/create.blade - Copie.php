{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Add Drop')


@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->


    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


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
				<form method="POST" role="form"  action="{{ route('drops.store') }}" enctype="multipart/form-data" >
			  		@csrf

					  	<div class="card blue darken-1"style="height:60px;">
        					<div class="card-content white-text" >
          						<span class="">@lang('locale.Network/Offer/ISP/Country')</span>
          
        					</div>        
      					</div>
						<div class="row">					
						   <div class="col s12" id="information">
								  <!-- users edit Info form start -->
								  <form id="infotabForm">
									<div class="row">
									  <div class="col s12 m6">
										<div class="row">
											<div class="col s12">
												<h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
											</div>
											<div class="col s12 input-field">
												<select class="form-control" name="networks" id="networks">
												  <option value="0" disable="true" selected="true"> Select networks </option>
													@foreach ($networks as $key => $value)
													  <option value="{{$value->id}}">{{ $value->name }}</option>
													@endforeach
												</select>
												<label for="Network">@lang('locale.Network')</label>
											</div>
											<div class="col s12">
												<select class="form-control" name="offres" id="offres">
													<option value="0" disable="true" selected="true"> Select offres </option>
												</select>
												<label for="Offer">@lang('locale.Offer')</label>                
											</div>
											<div class="col s12">
												 <label for="">Your files</label>
													<select class="form-control" name="files" id="files">
													  <option value="0" disable="true" selected="true"> Select files </option>
													</select>
												<label for="Offer">@lang('locale.Files')</label>                
											</div>											
											<div class="col s12 input-field">                    
												<select id="id_isps" name="id_isps">
												<option value="-1">Please select ISP</option>
													 @foreach($isp as $is)							
														<option id="{{ $is->id }}" value="{{ $is->id }}">{{ $is->name}}</option>
													@endforeach 
												</select>
												<label for="ISP">@lang('locale.ISP')</label>
											</div>
											   					 					
											<div class="col s12 input-field">
												<select class="form-control js-offres" id="country" name="country_id">
													<option value="-1">Please select COUNTRY</option>
													@foreach($country as $count)							
														<option id="{{ $count->id }}" value="{{ $count->id }}">{{ $count->name}}</option>
													@endforeach
												</select>
												<label for="Country">@lang('locale.Country')</label>   
													
											</div>
															
										</div>
										
									  </div>
									  <div class="col s12 m6" id="carousel-example-generic">
										<div class="row">
										  <div class="col s12">
											<h6 class="mb-4"><i class="material-icons mr-1">image</i>Images</h6>
										  </div>
										  <div class="col s12 input-field">
										   <div class="slider">
											<ul class="slides">
											 {{-- @foreach($files as $of)	  
											 <li>						
												<img src="/{{$of->path}}/{{$of->name}}">
												<div class="caption center-align">						  
												</div>
											  </li> 
											  @endforeach --}}
											</ul>
										  </div>
										  </div>


									</div>
								  </form>
								  <!-- users edit Info form ends -->
								</div>			
											
											</div>	
											<div class="card blue darken-1" style="height:60px;">
													<div class="card-content white-text">
														<span class="">@lang('locale.Body/Header') :</span>
								  
													</div>        
											</div>
												
											<div class="row"> 
												<div class="input-field col m6 s12">
													<select id="header" name="header">
															<option id="" value=""> </option>
													</select>
														<label for="Country">@lang('locale.ChooseHeader')</label>
												</div>
												<div class="input-field col m6 s12">
													<select id="body" name="body">
															<option id="" value=""> </option>
													</select>
														<label for="Country">@lang('locale.ChooseBody')</label>
												</div>
											</div>	
											<div class="row">   					
													
												<div class="input-field col m6 s12">
													<label for="header">@lang('locale.Headerd')</label> </br>
													<textarea class="" id="header"  rows="10" name="header" placeholder="" oninput="changedValue()"style="width:500px; height:200px;">subject:--
						fromName:--
						fromEmail: <[RandomC/6]@[domain]>
						date:[date]
						to:"[to]" <[to]>
						MessageID: <[RandomCD/45]>
						X-Message-Flag: Follow-Up
						content-type:text/html;</textarea>
													
													</div>       					
													
													<div class="input-field col m6 s12">
														<label for="body"> @lang('locale.Bodyd')	</label> </br>
														<textarea class="" id="body"  rows="10" name="body" placeholder="" oninput="changedValue()" style="width:500px; height:200px;">
						<html>
						<center>
						<a href="http://[domain]/[idSend][RandomC/3][idEmail][RandomC/3][idFrom][RandomC/3][idSubject][RandomC/3][idCreative][RandomC/3][idIP]yzo" style="text-decoration: none;">
						<font size="5" color="#8A0829">
						 ☞ ☞ Click Here!   </font></a>
						<br>
						<br>
						<center>
						<a href="http://[domain]/[idSend][RandomC/3][idEmail][RandomC/3][idFrom][RandomC/3][idSubject][RandomC/3][idCreative][RandomC/3][idIP]yzo">
						<img src="http://[domain]/[nameCreative]"/>
						</a>
						</center>
						<center>   
						<a href="http://[domain]/[idSend][RandomC/3][idEmail][RandomC/3][idFrom][RandomC/3][idSubject][RandomC/3][idCreative][RandomC/3][idIP]yzu">
						<img src="http://[domain]/[nameCreativeUnsub]"/>
						</a>
						</center>
						<br/><br/>
						<center>   
						<a href="http://[domain]/[idSend][RandomC/3][idEmail][RandomC/3][idFrom][RandomC/3][idSubject][RandomC/3][idCreative][RandomC/3][idIP]yoo">
						<img src="http://[domain]/OurUnsub1.png"/>
						</a>
						</center>
						<br/><br/>
						<center>   
						   <img style="width:0px;height:0px;display:none;" src="http://[domain]/[idSend][RandomC/2][idEmail][RandomC/2][idFrom][RandomC/2][idSubject][RandomC/2][idIP]=[sender]"/>
						</center>
						</body>
						</html>
														</textarea>
														
							
            				</div>       				
    					
					</div>
        

					<div class="row">
						<div class="input-field col s12">
					  		<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.CreatSend')
								<i class="material-icons right">send</i>
					  		</button>
					  		<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('domains.index') }}"></a> @lang('locale.Retour')
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
          $('#networks').on('change', function(e){
        console.log(e);
        var network_id = e.target.value;
        $.get('/json-offres?network_id=' + network_id,function(data) {
          console.log(data);
          $('#offres').empty();
          $('#offres').append('<option value="0" disable="true" selected="true">=== Select offres ===</option>');

          $('#files').empty();
          $('#files').append('<option value="0" disable="true" selected="true">=== Select files ===</option>');



          $.each(data, function(index, offresObj){
            $('#offres').append('<option value="'+ offresObj.id +'">'+ offresObj.name +'</option>');
          })
        });
      });

      $('#offres').on('change', function(e){
        console.log(e);
        var offre_id = e.target.value;
        $.get('/json-files?offre_id=' + offre_id,function(data) {
          console.log(data);
          $('#files').empty();
          $('#files').append('<option value="0" disable="true" selected="true">=== Select files ===</option>');

          $.each(data, function(index, filesObj){
            $('#files').append('<option value="'+ filesObj.id +'">'+ filesObj.name +'</option>');
          })
        });
      });


    </script>


@endsection
@section('javascript')
@endsection