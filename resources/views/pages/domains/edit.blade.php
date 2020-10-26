{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Domains')

{{-- main page content --}}
@section('content')

<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Domains')</h4>
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
          <form action="{{ route('domains.update',$domains->id) }}" method="POST">
		  @csrf
		  @method('PUT')
            <div class="row">
              <div class="input-field col m6 s12">
				<input type="text" id="first_name01" name="name" value="{{ $domains->name }}" placeholder="name">
                <label for="first_name01">@lang('locale.Name')</label>
              </div>
              <div class="input-field col m6 s12">
                <input type="text" name="saleDate"  id="saleDate"  class="assign-date datepicker" placeholder="sale Date" value="{{ $domains->saleDate }}">
				<label for="icon_attach_money">@lang('locale.SaleDate')</label>
              </div>
            </div>
            <div class="row">
             <div class="input-field col m6 s12">
                <input id="expirationDate" name="expirationDate" type="text" class="assign-date datepicker" placeholder="sale Date" value="{{ $domains->expirationDate }}">			
				<label for="icon_short_text">@lang('locale.ExpirationDate')  </label>
              </div>              
    
              <div class="col m6 s12 file-field input-field">			
					<select id="provider_id" name="provider_id">
						@foreach($providers as $provider)	
							@if (@$domains->provider_id===$provider->id)						
								<option id="{{ $provider->id }}" name="{{ $provider->id }}" value="{{ $provider->id }}" disabled selected >{{$provider->name}}</option>
							@else
							   <option id="{{ $provider->id }}" name="{{ $provider->id }}" value="{{ $provider->id }}">{{$provider->name}}</option>
							@endif
						@endforeach
					</select>		
				</div>
            </div>
              <div class="row">
                <div class="input-field col m12 s12">
						<button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
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
@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/advance-ui-carousel.js')}}"></script>
@endsection