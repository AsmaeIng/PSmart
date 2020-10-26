{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Edit Type Liste')

{{-- main page content --}}
@section('content')

<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Typeliste')</h4>
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
          <form action="{{ route('typelistes.update',$typelistes->id) }}" method="POST">
		  @csrf
		  @method('PUT')
            <div class="row">
              <div class="input-field col m6 s12">
				<input type="text" id="name" name="name" value="{{ $typelistes->name }}" placeholder="name">
                <label for="name">@lang('locale.Name')</label>
              </div>
              <div class="input-field col m6 s12">
                <input id="abriviation" type="text" name="abriviation"  value="{{ $typelistes->abriviation}}" >
                <label for="abriviation">@lang('locale.Abriviation')</label>
              </div>
            </div>
           <div class="row">
				<div class="input-field col s12">

				 <a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left" href="{{ route('typelistes.index') }}"> @lang('locale.Tocancel')</a>
					<button type="submit" class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 right">@lang('locale.Edit') <i class="material-icons right">send</i>
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