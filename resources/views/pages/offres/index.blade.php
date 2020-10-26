{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','offres')

{{-- vendor styles --}}
@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">

@endsection

{{-- page content --}}
@section('content')
<!-- invoice list -->
<section class="invoice-list-wrapper section">
  <!-- create invoice button-->
  <!-- Options and filter dropdown button-->
    <div class="row">
		<div class="col s12 m12 l12">
		  <div id="button-trigger" class="card card card-default scrollspy">
			<div class="card-content">
			  <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">shopping_basket</i>@lang('locale.Offre')</h4></center>
				<div class="row">
					<div class="col m4 s12"></div>
					<div class="col m4 s12">
						<div class="filter-btn">
							 <a href="{{asset('offres/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
							  <i class="material-icons">add</i>
							  <span class="hide-on-small-only">@lang('locale.NewOffre' )</span>
							</a>
						</div>		
					</div>
					<div class="col m4 s12"></div>
				</div>
			</div>
		  </div>
		</div>
	</div>

	<div class="responsive-table">
		<div  id="loading" style="display: none;">		
			<CENTER>
				<div class="preloader-wrapper big active">
					<div class="spinner-layer spinner-blue-only">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div><div class="gap-patch">
							<div class="circle"></div>
						</div><div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				</div>
			</CENTER>
		</div>
		<table class="table invoice-data-table white border-radius-4 pt-1" style="width:100%">
		  <thead>
			<tr>
				<!-- data table responsive icons -->
				<th></th>
				<!-- data table checkbox -->
				<th></th>
				<th class="all"><span>@lang('locale.name')#</span></th>
				<th class="all">@lang('locale.Subjects')</th>
				<th class="all">@lang('locale.network')</th>	
				<th class="all">@lang('locale.Active') </th>  
				<th class="all">@lang('locale.Sensitive')</th>
				<th class="all">@lang('locale.notWorkingDays')</th>
				<th class="none"></th>				
				<th class="all">Action</th>			
			</tr>
		  </thead>

		  <tbody>
		  @foreach ($data as $offre)
			<tr>
				<td></td>
				<td></td>
				<td><a href="{{ route('offres.show',$offre->id) }}">{{ $offre->name }}</a></td>
				<td>{{ $offre->subjects }}</td>
				<td>
					@foreach($networks as $net)	
						@if (@$offre->network_id===$net->id)
							{{ $net->name }}
						@endif
					@endforeach
				</td>			
				<td>
					<label>
						@if($offre->active == 'on')
							<span class="chip lighten-5 green green-text">Is Active</span>
						@elseif($offre->active =='null')
							<span class="chip lighten-5 red red-text">Not Active</span>
						@endif
					</label>
				</td>
				<td><label>
						@if($offre->sensitiv == 'on')
							<span class="chip lighten-5 green green-text">On</span>
						@elseif($offre->sensitiv =='off' or $offre->sensitiv =='' )
							<span class="chip lighten-5 red red-text">Off</span>
						@endif
					</label>
				</td>			
				<td>
					<span class="bullet red"></span><small>{{ $offre->notWorkingDays }}</small>
				</td>
				<td>
					<div class="row">							
						<div class="input-field col s4 "  ><strong>@lang('locale.Name') :</strong> {{$offre->name}}</div>
						<div class="input-field col s4 "  ><strong>@lang('locale.Subjects') :</strong>{{$offre->subjects }}</div>
						@foreach($networks as $net)	
						@if (@$offre->network_id===$net->id)
						<div class="input-field col s4 "  ><strong>@lang('locale.PlateformSponsor') :</strong>{{$net->name }}</div>
						@endif
						@endforeach
																
					</div>
					<div class="row">
						<div class="input-field col s4 "  >
							<label>
							@if($offre->sensitiv == 'on')
								<span class="chip lighten-5 green green-text">Sensitive On</span>
							@elseif($offre->sensitiv =='off' or $offre->sensitiv =='' )
								<span class="chip lighten-5 red red-text">Sensitive Off</span>
							@endif
							</label>
						</div>
						<div class="input-field col s4 "  ><strong>@lang('locale.notWorkingDays') :</strong>{{$offre->notWorkingDays }}</div>
						<div class="input-field col s4 "  ><strong>@lang('locale.froms') :</strong>{{$offre->froms }} </div>				
					</div>
					<div class="row">
						@foreach($verticals as $net)	
						@if (@$offre->vertical_id===$net->id)
							<div class="input-field col s4 "  ><strong>@lang('locale.vertical') :</strong> {{$net->name }}</div>
						@endif
						@endforeach
						@foreach($countrys as $net)	
						@if (@$offre->country_id===$net->id)
						<div class="input-field col s4 "  ><strong>@lang('locale.country') :</strong>{{$net->name }}</div>
						@endif
						@endforeach
						<div class="input-field col m4 s12">            
							<label style="position: inherit;">
								@if($offre->active == 'on')
									<span id="active" class="chip lighten-5 green green-text" >Is Active</span>
								@elseif($offre->active =='' )
									<span id="active" class="chip lighten-5 red red-text">Not Active</span>
								@endif
							</label>
						</div>								
					</div>		
				</td>
				<td colspan="3">
					<div class="invoice-action">
						<a href="{{ route('offres.show',$offre->id) }}" onclick="window.open(this.href);return false" class="invoice-action-view mr-4">
							<i class="material-icons">remove_red_eye</i>
						</a>
						<a href="{{ route('offres.edit',$offre->id) }}" onclick="window.open(this.href);return false" class="invoice-action-edit">
							<i class="material-icons">edit</i>
						</a>
						<a href="{{ route('offres.delete',$offre->id) }}" class="invoice-action-edit">
							<i class="material-icons">delete_forever</i>
						</a>
						{{--<a href="#" class="btnDownloadSuppressionFile invoice-action-edit"  onClick="download({{$offre->id}});return false;"><!--target="_blank" -->--}}
						<a href="#" onclick="downloadfile({{$offre->id}}); return false;">
						<i class="material-icons">cloud_download</i>{{-- href="{{ route('offres.SuppFile',$offre->id) }}"--}}
					</a>
					</div>
				</td>
				
			</tr>
		@endforeach 
      </tbody>
    </table>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	function downloadfile(id){
		$('#loading').show();
		$.get
			(
				"/offres/SuppFile/"+id,				
				function(ajax_return)
				{
					console.log(ajax_return);
					alert(ajax_return);
					$('#loading').hide();
				}
			);
	}
	 


</script>
@endsection
{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection