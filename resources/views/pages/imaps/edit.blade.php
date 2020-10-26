{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Imap')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Imap')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Imap')</h4>
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
          <form action="{{ route('imaps.update',$imap->id) }}" method="POST">
		  @csrf
		  @method('PUT')
            <div class="row">
              <div class="input-field col m3 s12">
				<select id="id_isps" name="id_isps">
					@foreach($isps as $isp)		
							@if (@$imap->id_isps===$isp->id)						
								<option id="{{ $isp->id }}" name="{{ $isp->id }}" value="{{ $isp->id }}"  disabled selected>{{$isp->name}}</option>
							@else
							   <option id="{{ $isp->id }}" name="{{ $isp->id }}" value="{{ $isp->id }}">{{$isp->name}}</option>
							@endif
						@endforeach
				</select>
				<label for="isps">@lang('locale.ListeISPS')  </label>
              </div>
              <div class="input-field col m3 s12">
                <input id="Email" type="text" name="Email"  value="{{ $imap->Email}}" >
                <label for="Email">@lang('locale.Email')</label>
              </div>

             <div class="input-field col m3 s12">
                <textarea id="Password" name="Password" class="materialize-textarea">{{ $imap->Password }}</textarea>
                <label for="Password">@lang('locale.Password')</label>
              </div>              

              <div class="col m3 s12 file-field input-field">			
					<select id="Folder" name="Folder">
						<option value="1">INBOX</option>
						<option value="2">SPAM</option>
					</select>
					<label>Folder</label>			
			  </div>
            </div>
			<div class="row">
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					</button>
					<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('imaps.index') }}"></a> @lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					</button>
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
@endsection