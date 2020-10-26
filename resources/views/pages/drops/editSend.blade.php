{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title','Edit Send')

{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<style>


</style>

@endsection

{{-- page content --}}
@section('content')
<div class="seaction">

  
<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.EditSend')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>

  <!--Basic Form-->

  <!-- jQuery Plugin Initialization -->
    <div class="row">
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <header class="panel-heading">
                        <div class="card-title">
                        
                            <div class="col s6 m3 8">
                            </div>
                            <div class="col s6 m3 8">
                            </div>
                            <div class="col s6 m3 8">
                            </div>
                            <div class="panel-actions s6 m3 8">
                                <a href="#" ><i class="material-icons prefix">keyboard_arrow_down</i>  </a>
                                <a href="#" ><i class="material-icons prefix">cached</i> </a>
                                <a href="#myModal" id="myBtn" title="Help" style="cursor:pointer;" role="button" data-toggle="modal" data-target="#myModal" ><i class="material-icons prefix">more</i></a>
                            </div>
                        </div>
                        <h4 class=""> @lang('locale.HeaderElement')</h4>
                    </header>
                    <form>
                        <div class="row">
                            <div class="input-field col s10">
                                <div class="col s5 file-field input-field">			
                                    <select id="from" name="from">
                                        <option id="" value=""></option>
                                    </select>
                                    <label for="Network">@lang('locale.From')</label>							
                                </div>
                                <div class="col s5 file-field input-field">			
                                    <select id="typeEncoding" name="typeEncoding">
                                        <option value="0">Type Encoding From</option>
										<option value="UTF-7">UTF-7</option>
										<option value="UTF-8">UTF-8</option>
										<option value="UTF-16">UTF-16</option>
										<option value="UTF-32">UTF-32</option>
										<option value="ASCII">ASCII</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s10">
                                <div class="col s5 file-field input-field">			
                                    <select id="subject" name="subject">
                                        <option id="" value=""></option>
                                    </select>
                                    <label for="Network">@lang('locale.Subjects')</label>							
                                </div>
                                <div class="col s5 file-field input-field">			
                                    <select id="typeEncoding1" name="typeEncoding1">
                                        <option value="0">Type Encoding Subj</option>
										<option value="UTF-7">UTF-7</option>
										<option value="UTF-8">UTF-8</option>
										<option value="UTF-16">UTF-16</option>
										<option value="UTF-32">UTF-32</option>
										<option value="ASCII">ASCII</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10">
                                <input id="returnPath" type="text">
                                <label for="returnPath">@lang('locale.ReturnPath')</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10">		
                                    <select id="negative" name="negative">
                                        <option id="" value=""></option>
                                    </select>
                                    <label for="negative">@lang('locale.negative')</label>							
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s10">
                                <input id="startFrom" type="number" class="form-control">
                                <label for="startFrom">@lang('locale.StartFrom')</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s10">
                                <label for="emailTest">@lang('locale.EmailTest')</label> </br>
                                <i class="material-icons prefix">email</i>                        
                                <textarea placeholder="one email test per line" class="form-control" name="emailTest" id="emailTest" rows="2" style="width:400px; "></textarea>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10">
                                <label class="">@lang('locale.Header')</label></br></br>
                                    
                                <textarea class="form-control" name="header" id="header" rows="10" style="width:450px; height:200px;"></textarea>
                                
                            </div>
                        </div> 
                    </form>               
                              
            </div>
        </div>
    </div>


    <!-- Form 2 -->
    <div class="col s12 m6 l6">
        <div id="placeholder" class="card card card-default scrollspy">
            <div class="card-content">
                <header class="panel-heading">
                    <div class="row">
                        <div class="col s6 m3 8">
                        </div>
                        <div class="col s6 m3 8">
                        </div>
                        <div class="col s6 m3 8">
                        </div>
                        <div class="panel-actions s6 m3 8">
                            <a href="#" ><i class="material-icons prefix">keyboard_arrow_down</i>  </a>
                            <a href="#" ><i class="material-icons prefix">cached</i> </a>
                            <a href="#"  title="Help" style="cursor:pointer;" role="button" data-toggle="modal" ><i class="material-icons">remove_red_eye</i></a>
                            <a href="#myModal"  id="myBtn" title="Help" style="cursor:pointer;" role="button" data-target="#myModal" data-toggle="modal" ><i class="material-icons prefix">more</i></a>
                        </div>
                    </div>
					<h4 class="">@lang('locale.Body/Header')</h4>								
				</header>
                    <div class="row">
                        <div class="input-field col s12">
                            <label class="">@lang('locale.Body')</label></br></br>
                            <textarea class="form-control" name="body" id="header" style="width:500px; height:800px;" rows="50"></textarea>
                        </div>
                    </div>                    
            </div>
        </div>
    </div>
    <!--form 3 -->
    <div class="col m12 ">
        <div id="placeholder" class="card card card-default scrollspy">
            <div class="card-content">
                <header class="panel-heading">
                        <div class="card-title">
                        
                           
                            <div class="col s12 m6 ">
                            </div>
                            <div class="col s6 m3 ">
                            </div>
                            
                            <div class="panel-actions s6 m3 ">
                                <a href="#" ><i class="material-icons prefix">keyboard_arrow_down</i>  </a>
                                <a href="#" ><i class="material-icons prefix">cached</i> </a>
                                <a href="#myModal" id="myBtn" title="Help" style="cursor:pointer;" role="button" data-target="#myModal" data-toggle="modal" ><i class="material-icons prefix">more</i></a>
                            </div>
                        </div>
                        <h4 class="">@lang('locale.Servers')</h4>	
                </header>
                <div class="row">
                    <div class="input-field col m12 s12">
                        <div class="form-group">
                            <div class="col m6 s12">
                                <div class="form-group">
                                    <label style="cursor:pointer;" data-toggle="modal" data-target=""><span class="label btn btn-warning">@lang('locale.Server')</span></label>
                                   <select class="browser-default" name="server_id" id="server_id">
										<option value="0" disable="true" selected="true"> Select Server </option>
										@foreach ($servers as $key => $value)
											<option value="{{$value->id}}">{{ $value->alias }}</option>
										@endforeach
									</select>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class="form-group">
                                    <label style="cursor:pointer;" data-toggle="modal" data-target=""><span class="label btn btn-warning">@lang('locale.VMTA')</span></label>
                                    <select class="browser-default" name="ip_id" id="ip_id">
										<option value="0" disable="true" selected="true"> Select IP </option>
									</select>                        
								</div>
                            </div>
                         </div>
                     </div> 
                </div>	
    
                <div class="row">
                    <div class="input-field col m12 s12">
                        <div class="form-group">
                            <div class="col m6 s12 ">   
                                <div class="form-group">   
                                    <select multiple class="form-control" id="server_id" name="server_id">
                                        <option id="" value=""></option>
                                    </select>                          
                                                
                                </div>
                            </div>
                        </div>
                        <div class="col m6 s12"> 
                            <div class="form-group">                            
                                <select multiple class="form-control" id="vmta">
                                    <option></option>
                                </select>
                            </div>
                                
                        </div>
                    </div>
                </div>			
                <div class="row">
                    <div class="input-field col  s12">
                        <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.SendTestMail')
                            
                        </button>
                        <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action"><a href="#"></a>@lang('locale.Update')
                         
                        </button>
                        <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('drops.index') }}"></a> @lang('locale.Retour')
                            <i class="material-icons right">keyboard_return</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- modal -->
    <div class="modal" id="myModal"   tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="alert alert-info alert-styled-left text-blue-800 content-group">
						<span class="text-semibold">Explanation of existing tags</span> 
					</div>
					<h6 class="text-semibold">
    					<i class="icon-server position-left"></i> [sr] : Server Name 
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="glyphicon glyphicon-user"></i> [link] : : Name of a mailbox (The part before the @) 
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="icon-lan position-left"></i> [ip] : IP 
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="icon-earth position-left"></i> [domain] : Domain
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="icon-calendar52 position-left"></i> [date] : Current Date
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class=" icon-envelope position-left"></i> [to] : Recipient
					</h6>
					<hr>												
					<h6 class="text-semibold">
						<i class="icon-menu6 position-left"></i> [nega] : Negative
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="icon-sort-alpha-desc position-left"></i> [RandomC/5] : Characters
					</h6>
					<hr>
					<h6 class="text-semibold">
						<i class="icon-sort-numeric-asc position-left"></i> [RandomD/5] : Numbers
					</h6>
					<hr>															
					<h6 class="text-semibold">
						<i class="icon-sort position-left"></i> [RandomCD/5] : Alpha-Numeric
					</h6>
					<hr>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="close" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
// Get the modal
// var modal = document.getElementById("myModal");

// Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// btn.onclick = function() {
  // modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
  // modal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
  // if (event.target == modal) {
    // modal.style.display = "none";
  // }
// }
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">  
	 $('#server_id').on('change', function(e){
        console.log(e);
        var server_id = e.target.value;
        $.get('/json-ips?server_id=' + server_id,function(data) {
          $('#ip_id').empty();
          $('#ip_id').append('<option value="0" disable="true" selected="true"> Select IP </option>');		 
          $.each(data, function(index, ipsObj){
            $('#ip_id').append('<option value="'+ ipsObj.id +'"  >'+ ipsObj.IP +'</option>');
          })
        });
      }); 
</script>


@endsection