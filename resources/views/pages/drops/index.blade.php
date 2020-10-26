{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Drops')

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
	<!-- create invoice button-->
	<div class="row">
		<div class="col s12 m12 l12">
			<div id="button-trigger" class="card card card-default scrollspy">
				<div class="card-content">
					<center><h4 class="card-title"><i class="material-icons app-header-icon text-top">location_city</i>@lang('locale.Drops')</h4></center>
						<div class="row">
							<div class="col m4 s12"></div>
							<div class="col m4 s12">
								<div class="filter-btn">
									<a href="{{ route('drops.create') }}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
										<i class="material-icons">add</i>
										<span class="hide-on-small-only">@lang('locale.NewDrops' )</span>
									</a>
								</div>			
							</div>
							<div class="col m4 s12">
								<form id="periode" method="GET" action="{{ route('drops.show') }}" >
									@csrf
									<select id="created_at" name="created_at" onchange="document.getElementById('periode').submit()">
										@if($dat=="Today")						
											<option id="Today" value="Today" selected>@lang('locale.Today')</option>
										@else
											<option id="Today" value="Today" selected>@lang('locale.Today')</option>
										@endif
										@if($dat=="Yesterday")
											<option id="Yesterday" value="Yesterday" selected >@lang('locale.Yesterday')</option>
										@else
											<option id="Yesterday" value="Yesterday">@lang('locale.Yesterday')</option>
										@endif
										@if($dat=="Last7Days")
											<option id="Last7Days" value="Last7Days" selected>@lang('locale.Last7Days')</option>
										@else
											<option id="Last7Days" value="Last7Days">@lang('locale.Last7Days')</option>
										@endif
										@if($dat=="Last30Days")
											<option id="Last30Days" value="Last30Days" selected>@lang('locale.Last30Days')</option>
										@else
											<option id="Last30Days" value="Last30Days" >@lang('locale.Last30Days')</option>
										@endif
										@if($dat=="LastMonth")
											<option id="LastMonth" value="LastMonth" selected>@lang('locale.LastMonth')</option>
										@else 
											<option id="LastMonth" value="LastMonth">@lang('locale.LastMonth')</option>
										@endif
											<option id="customRange" value="customRange">@lang('locale.customRange')</option>
										
									</select>
									<!--<div class="input-field col s12">
										<button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('locale.Show')
											<i class="material-icons right">send</i>
										</button>
									-->	

								</form>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	 
	<div class="responsive-table">
		  <!--<form method="POST" action="{{ route('sends.store') }}" >
			@csrf -->							 
				<table class="table invoice-data-table white border-radius-4 pt-1" id="" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th class="all"><center>@lang('locale.idSend')</center></th>         
							<th class="all"><center>@lang('locale.offer')</center></th>
							<th class="all"><center>@lang('locale.Isp')</center></th>
							<th class="all"><center>@lang('locale.list')</center></th>
							<th class="all"><center>@lang('locale.fraction')</center></th>
							<th class="all"><center>@lang('locale.seed')</center></th>
							<th class="all"><center>@lang('locale.X-delay')</center></th>
							<th class="all"><center>@lang('locale.count')</center></th>
							<th class="none"></th>
							<th class="all"><center>Action</center></th>		  		  										
						</tr>							
					</thead>
					<tbody>
						@foreach ($data as $drop)
							<form method="GET" action="{{ route('sends.store') }}" >
								@csrf
								<tr>			
									<td></td>
									<td></td>
									<td><center>{{$drop->id}}</center></td>         
									<td>
										<center>	
											@foreach($offres as $offre)	
												@if (@$drop->offre_id === $offre->id)
													<!--<input id="offre_id" name="offre_id" type="hidden" value="{{$offre->id}}">-->
													{{$offre->name}}
												@endif
											@endforeach
										</center>
									</td>
									<td> 
										<center>
											@foreach($isps as $isp)	
												@if (@$drop->id_isps===$isp->id)
													<!--<input id="id_isps" name="id_isps" type="hidden" value="{{$isp->id}}">-->
													{{$isp->name}}
											@endif
											@endforeach
										</center>
									</td>
									<td> 
										<center>
											
											@foreach($drop->listesends as $id => $listesends)								
													{{ $listesends->name }} 
											@endforeach 
										</center>
									</td>
									<td><center>fraction</center></td>
									<td><center>seed</center></td>
									<td><center>x_delay</center></td>
									<td><center>count</center></td>
									<td>
										<div class="row">
											<div class="input-field col m4 s12 "  >
												@foreach($networks as $net)	
													@if (@$drop->network_id===$net->id)
														<strong>@lang('locale.PlateformSponsor') :</strong> {{$net->name}}
													@endif
												@endforeach
											</div>
											<div class="input-field col m4 s12 "  >
												@foreach($offres as $offre)	
													@if (@$drop->offre_id === $offre->id)
														<strong>@lang('locale.Offre') :</strong> {{$offre->name}}
													@endif
												@endforeach
											</div>
											<div class="input-field col m4 s12 "  >
												@foreach($isps as $isp)	
													@if (@$drop->id_isps===$isp->id)
														<strong>@lang('locale.Isp') :</strong> {{$isp->name}} 
													@endif
												@endforeach
											</div>
										</div>
										<div class="row">
																													
												<div class="input-field col m4 s12 "  ><strong>@lang('locale.liste') :</strong>
													@foreach($drop->listesends as $id => $listesends) {{$listesends->name}} ,  @endforeach 
												</div>												
												<div class="input-field col m4 s12 "  >
													@foreach($headers as $header)	
														@if (@$drop->header_id === $header->id)
															<strong>@lang('locale.Header') :</strong> {{$header->name}}
														@endif
													@endforeach
												</div>
												<div class="input-field col m4 s12 "  >
													@foreach($bodys as $body)	
														@if (@$drop->body_id === $body->id)
															<strong>@lang('locale.Body') :</strong> {{$body->name}} 
														@endif
													@endforeach
												</div>	
										</div>
										<div class="row">
																													
												<div class="input-field col m4 s12 "  ><strong>@lang('locale.server') :</strong>
													@foreach($drop->servers as $id => $servers) {{$servers->alias}} ,  @endforeach 
												</div>												
												<div class="input-field col m4 s12 "  ><strong>@lang('locale.IP') :</strong>
													@foreach($drop->sips as $id => $sips) {{$sips->IP}} ,  @endforeach 
												</div>	
										</div>
									</td>
									<td>
										<div class="invoice-action">
										<!--<button class="invoice-action-edit" type="submit" name="action">
												<i class="material-icons ">mail</i>
											</button>-->		
											
								
											<a href="{{ route('sends.send',$drop->id) }}" class="invoice-action-view mr-4" name="action">
												<i class="material-icons">mail</i>
											</a>
											<a href="{{ route('sends.edit',$drop->id) }}" class="invoice-action-edit"><!--,$drop->id-->
												<i class="material-icons">edit</i>
											</a>
											<a href="{{ route('drops.edit',$drop->id) }}" class="invoice-action-edit"><!--,$drop->id-->
												<i class="material-icons">mode_edit</i>
											</a>
											<a href="{{ route('drops.delete',$drop->id) }}" class="invoice-action-delete">
												<i class="material-icons">delete_forever</i>
											</a>
											<a href="" class="invoice-action-edit">
												<i class="material-icons">near_me</i>
											</a>
											<a href="" class="invoice-action-edit">
												<i class="material-icons">pause</i>
											</a>
											<a href="" class="invoice-action-edit">
												<i class="material-icons">insert_chart</i>
											</a>
										</div>
									</td>
								</tr>
							</form>
						@endforeach 
					</tbody>
				</table>
		
	  </div>
</section>

<script>

var table = $('#network').DataTable({
  responsive: {
    details: {
      type: 'column'
    }
  },
  columnDefs: [{
    className: 'control',
    orderable: false,
    targets: 0
  }],
  order: [1, 'asc']
});

$('#btn-show-all-doc').on('click', expandCollapseAll);

function expandCollapseAll() {
  table.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length || 
  table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
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