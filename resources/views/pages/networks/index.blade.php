{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Networks')

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
          <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">location_city</i>@lang('locale.Networks')</h4></center>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
				<div class="filter-btn">
					<a href="{{ route('networks.create') }}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						<i class="material-icons">add</i>
						<span class="hide-on-small-only">@lang('locale.NewNetwork' )</span>
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
    <table class="table invoice-data-table white border-radius-4 pt-1" id="network" style="width:100%">
      <thead>
        <tr>
          <!-- data table responsive icons -->
          <th></th>
          <!-- data table checkbox-->
          <th></th> 
          <th class="all"><center>@lang('locale.Name')</center></th>         
          <th class="all"><center>Logo</center></th>
		  <th class="all"><center>@lang('locale.Active')</center></th>
		  <th class="all"><center>@lang('locale.AffiliateID')</center></th>
		  <th class="all"><center>@lang('locale.APIAccessKey')</center></th>
		  <th class="none"></th>
          <th class="all"><center>Action</center></th>		  		  										
        </tr>
		
		
      </thead>

      <tbody>
	  @foreach ($data as $network)
        <tr>
          <td></td>
          <td></td>
          <td><center><a target="_blank" href="{{$network->APIHostURL }}">{{$network->name}}</a></center></td>                           
          <td><center>
			@foreach($logonetworks as $log)	
				@if (@$network->id===$log->network_id)
				<a href="/{{$log->path}}/{{$log->name}}" title="The Cleaner">
					<img src="/{{$log->path}}/{{$log->name}}" class="responsive-img " height="64" width="64"  alt="{{$log->name}}">
				</a>
				@endif
			@endforeach
			</center>
          </td>		  
		  <td><center> 
				@if($network->type == 'on')
				<span class="chip lighten-5 green green-text">Is Active</span>
				@elseif($network->type =='NULL' or $network->type =='')
				<span class="chip lighten-5 red red-text">Not Active</span>
				@endif
				</center>
			</td>
		  <td><center><span class="invoice-customer">{{$network->AffiliateID}}</span></center></td>
		  <td><center>{{$network->APIAccessKey}}</center></td> 
		  <td>
			<div class="row">	
				@foreach($plateforms as $net)	
                    @if (@$network->plateform_id===$net->id)
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.PlateformSponsor') :</strong>{{$net->name }}</div>
				@endif
				@endforeach
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.Name') :</strong> {{$network->name}}</div>
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.Type') :</strong>{{$network->type}} </div>
								
			</div>
			<div class="row">
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.Login') :</strong>{{$network->login }}</div>
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.Password') :</strong>{{$network->password }}</div>
				<div class="input-field col m4 s12 "  ><strong>@lang('locale.AffiliateID') :</strong>{{$network->AffiliateID}} </div>				
			</div>
			<div class="row">	
				<div class="input-field col m6 s12 "  ><strong>@lang('locale.APIAccessKey') :</strong> {{$network->APIAccessKey}}</div>
				<div class="input-field col m6 s12 "  ><strong>@lang('locale.APIHostURL') :</strong>{{$network->APIHostURL }}</div>																			
			</div>
			<div class="row">	
				<div class="input-field col m6 s12"  ><strong>@lang('locale.URLSignIn') :</strong> {{$network->URLSignIn}}</div>	
				<div class="input-field col m6 s12 "  ><strong>@lang('locale.token') :</strong>@if (@$network->token !='Null') yes @else NO @endif</div>																			
			</div>		
		  </td>
          <td>
            <div class="invoice-action">
				<center>
					<a href="{{ route('networks.show',$network->id) }}" class="btn-floating mb-1 btn-flat waves-effect waves-light blue accent-2 white-text">
						<i class="material-icons">remove_red_eye</i>
					</a>				
					<a href="{{ route('networks.edit',$network->id) }}" class="btn-floating mb-1 btn-flat waves-effect waves-light green darken-1 white-text">
						<i class="material-icons">edit</i>
					</a>
					<a href="{{ route('networks.delete',$network->id) }}" class="btn-floating mb-1 btn-flat waves-effect waves-light red accent-2 white-text">
						<i class="material-icons">delete_forever</i>
					</a>
					<a href="{{ route('networks.goNetwork',$network->id) }}"  target="_blank" class="btn-floating mb-1 btn-flat waves-effect waves-light blue accent-2 white-text">
						<i class="material-icons">input</i>
					</a>
					<a href="{{ route('networks.goNetworkOffre',$network->id) }}"  target="_blank" class="btn-floating mb-1 btn-flat waves-effect waves-light blue accent-2 white-text">
						<i class="material-icons">store_mall_directory</i>
					</a>
					<a href="{{ route('networks.Offrenetwork',$network->id) }}"  target="_blank" class="btn-floating mb-1 btn-flat waves-effect waves-light blue accent-2 white-text">
						<i class="material-icons">store_mall_directory</i>
					</a>
				</center>
            </div>
          </td>
        </tr>

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