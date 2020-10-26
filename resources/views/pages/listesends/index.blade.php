{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Liste Sends')

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
          <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">liste</i>@lang('locale.Listesends')</h4></center>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
				<div class="filter-btn">
					<a href="{{ route('listesends.create') }}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						<i class="material-icons">add</i>
						<span class="hide-on-small-only">@lang('locale.Add')</span>
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
    <table class="table invoice-data-table white border-radius-4 pt-1" id="liste" style="width:100%">
      <thead>
        <tr>
			<!-- data table responsive icons -->
			<th></th>
			<!-- data table checkbox-->
			<th></th>
			<th class="all">@lang('locale.Name')</th>
			<th class="all">@lang('locale.country')</th>       
		    <th class="all">@lang('locale.Active')</th>
	    	<th class="all">@lang('locale.OptIN')</th>
			<th class="all">@lang('locale.ISP')</th>
			<th class="all">@lang('locale.NrNewEmail')</th>		    
			<th class="none"></th>	
			<th class="all">Action</th>		  		  										
        </tr>		
      </thead>

      <tbody>
	  @foreach ($data as $listesend)
        <tr>
			<td></td>
			<td></td>
			<td><center><small>{{$listesend->name}}</small></center></td>
			<td>
				<center>	@foreach($country as $count)								
								@if (@$listesend->country_id===$count->id)						
									{{$count->sortname}}
								@endif
							@endforeach
				</center>
			</td>         
			<td>
				<center>
				@if($listesend->active == 'on')
					<span class="chip lighten-5 green green-text" >Is Active</span>
				@elseif($listesend->active ==NULL)
					<span class="chip lighten-5 red red-text">Not Active</span>
				@endif
				</center>
			</td>
			<td><center>
				@if($listesend->optIn == 'on')
					<span class="chip lighten-5 green green-text">Is Active</span>
				@elseif($listesend->optIn ==NULL)
					<span class="chip lighten-5 red red-text">Not Active</span>
				@endif
				</center>
			</td>
			<td>	
				@foreach($isps as $isp)	
                    @if (@$listesend->isp_id===$isp->id)						
						<center><span class="invoice-customer">{{$isp->name}}</span></center>
					@endif
				@endforeach
					
			</td>
			<td><center><span class="invoice-customer">{{$listesend->Fields}}</span></center></td>
			<td>
				<div class="row" >	       
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.Name') :</strong>{{$listesend->name}}</div>	
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.country') :</strong> 

							@foreach($country as $count)								
								@if (@$listesend->country_id===$count->id)						
									{{$count->sortname}}
								@endif
							@endforeach
					</div>								
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.Active') :</strong>
						@if($listesend->active == 'on')
							<span class="chip lighten-5 green green-text" >Is Active</span>
						@elseif($listesend->active ==NULL)
							<span class="chip lighten-5 red red-text">Not Active</span>
						@endif
					</div>	
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.OptIN') :</strong>
						@if($listesend->optIn == 'on')
							<span class="chip lighten-5 green green-text">Is OptIN</span>
						@elseif($listesend->optIn ==NULL)
							<span class="chip lighten-5 red red-text">Not OptIN</span>
						@endif
					</div>								
				</div>
				<div class="row">	          
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.ISP') :</strong>
								@foreach($isps as $isp)	
								@if (@$listesend->isp_id===$isp->id)						
									{{$isp->name}}
								@endif
								@endforeach
					</div>
					<div class="input-field col m3 s12 "  ><strong>Type :</strong>
								@foreach($typeliste as $typel)	
								@if (@$listesend->typeListe_id===$typel->id)						
									{{$typel->name}}
								@endif
								@endforeach
					</div>	
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.NrNewEmail') :</strong>{{$listesend->Fields}}</div>	
					<div class="input-field col m3 s12 "  ><strong>@lang('locale.Delimiter') :</strong>{{$listesend->delimiter}}</div>
				</div>
				<div class="row">				
					<div class="input-field col m4 s12 "  ><strong>@lang('locale.FirstName') :</strong> {{$listesend->firstname}}</div>								
					<div class="input-field col m4 s12 "  ><strong>@lang('locale.LastName') :</strong>{{$listesend->lastname}}</div>	
					<div class="input-field col m4 s12 "  ><strong>@lang('locale.Email') :</strong> {{$listesend->email}}</div>								
				</div>		
				
			</td>
			<td>
				<div class="invoice-action">
					<a href="{{ route('listesends.edit',$listesend->id) }}" class="invoice-action-edit">
						<i class="material-icons">edit</i>
					</a>
					<a href="{{ route('listesends.delete',$listesend->id) }}" class="invoice-action-delete">
						<i class="material-icons">delete_forever</i>
					</a>
					<a href="{{ route('listesends.uploadData',$listesend->id) }}" class="invoice-action-delete">
						<i class="material-icons">file_upload</i>
					</a>
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