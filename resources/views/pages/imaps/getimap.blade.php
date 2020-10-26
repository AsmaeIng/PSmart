{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Get Imap')
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
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">note_add</i>@lang('locale.Imap')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>				
<div class="col s12 m12 l12">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content"> 
          <h4 class="card-title">@lang('locale.Newimap')</h4> 
			<form method="POST" action="{{ route('imaps.getImap') }}" >
			  @csrf
				<div class="row">
					<div class="input-field col m3 s6">
						<select id="id_isps" name="id_isps">
						
                            @foreach($isps as $ispp)								
								            @if ($isp===$ispp)
                                <option id="{{ $ispp->id }}" value="{{ $ispp->name }}" selected>{{$ispp->name}}</option>
    				                @else
                        		    <option id="{{ $ispp->id }}" value="{{ $ispp->name }}" >{{$ispp->name}}</option>
                    			  @endif
							@endforeach
						</select>			
						<label for="isps">@lang('locale.ListeISPS')  </label>
					</div>
					<div class="input-field col m3 s6">
						<input id="Email" type="email" class="validate" name="Email"  value="{{$username}}"  placeholder="Email">
						<label for="Email">@lang('locale.Email')</label>
					</div>			  
					<div class="input-field col m3 s6">
						<input id="Password" type="password" class="validate" name="Password"  value="{{$password}}" placeholder="Password">
						<label for="Password">@lang('locale.Password')</label>
					</div>
					<div class="input-field col m3 s6">					
						<select id="Folder" name="Folder">
                            @if ($folder==="INBOX")
                                <option value="INBOX" selected>INBOX</option>
    				        @else
                                <option value="INBOX" >INBOX</option>
                    		    @endif
                            @if ($folder==="SPAM")
                                <option value="SPAM" selected>SPAM</option>
    				        @else
                                <option value="SPAM" >SPAM</option>
                    		@endif
						</select>
						<label>Folder</label>			
					</div>
				</div>	
                <div class="row">
                    <table>
                        <thead>
                                <tr>
                                    <th>     </th>
                                    <th>@lang('locale.From') </th>
                                    <th>@lang('locale.FromAdress')</th>
                                    <th>@lang('locale.Subject')</th>
                                    
                                    
                                </tr>
                        </thead>
                        <tbody>
                            
                            @for($m=0;$m<$c;$m++)
                                    <tr>
                                        <td>{{$m}}</td>
                                        <td>{{ $from[$m] }}   </td>
                                        <td>{{ $fromAdd[$m] }}</td>
                                        <td>{{ $subject[$m] }}</td>
                                    </tr>
                                
                            @endfor                            
                        
                        </tbody>
                    
                    </table>
                
                </div>	
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.GO')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('imaps.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					  </button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection