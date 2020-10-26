{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Creative')

{{-- main page content --}}
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Creative')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Creative')</h4>
          <form action="{{ route('creatives.update',$creatives->id) }}" method="POST">
		  @csrf
		  @method('PUT')
            <div class="row">
                <div class="col s3 file-field input-field">			
							<select id="network_id" name="network_id">
                                <option value=""></option>
								@foreach($network as $net)	
                                    @if (@$creatives->network_id===$net->id)						
									<option id="{{ $net->id }}" name="{{ $net->id }}" value="{{ $net->id }}"selected>{{ $net->name}}</option>
                                    @else
                                    <option id="{{ $net->id }}"name="{{ $net->id }}" value="{{ $net->id }}">{{ $net->name}}</option>
                                    @endif
								@endforeach
							</select>
							<label for="Network">@lang('locale.Network')</label>
							
				</div>      
                <div class="col s3 file-field input-field">			
							<select id="vertical_id" name="vertical_id">
								@foreach($vertical as $vert)
                                    @if (@$creatives->vertical_id===$vert->id)								
									<option id="{{ $vert->id }}" name="{{ $vert->id }}" value="{{ $vert->id }}" selected>{{ $vert->name}}</option>
                                    @else 
                                    <option id="{{ $vert->id }}" name="{{ $vert->id }}" value="{{ $vert->id }}">{{ $vert->name}}</option>
                                    @endif
                                @endforeach
							</select>
							<label for="Offer">@lang('locale.vertical')</label>
							
				</div>  
                <div class="col s3 file-field input-field">			
							<select id="offre_id" name="offre_id">
								@foreach($offer as $off)
                                    @if (@$creatives->offre_id===$off->id)								
									<option id="{{ $off->id }}" name="{{ $off->id }}" value="{{ $off->id }}" selected>{{ $off->name}}</option>
                                    @else 
                                    <option id="{{ $off->id }}" name="{{ $off->id }}" value="{{ $off->id }}">{{ $off->name}}</option>
                                    @endif
                                @endforeach
							</select>
							<label for="Offer">@lang('locale.Offer')</label>
							
				</div> 
                

              <div class="col m6 s12 file-field input-field">			
				<div class="float-right btn-floating mb-1 waves-effect waves-light gradient-45deg-orange-amber">
					<span><i class="material-icons">cloud_download</i></span>
					<input type="file">
				</div>
				<div class="file-path-wrapper">
				<i class="material-icons prefix">image</i>
					<input class="file-path validate" type="text"value="{{ $creatives->creative}}" >
				</div>			
			  </div>
            </div>
				<div class="row">
					<div class="input-field col s12">
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right" type="submit" name="action">@lang('locale.Edit')
						<i class="material-icons right">send</i>
					  </button>
					  <button class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  name="action"><a href="{{ route('creatives.index') }}"></a> @lang('locale.Retour')
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