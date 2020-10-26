{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Show History')

{{-- vendor styles --}}
@section('vendor-style')

<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<!--<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />-->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
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
          <h4 class="card-title">@lang('locale.ShowHistory')</h4>
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
			</div>
		</div>
	  </div>
	</div>
 </div>
 
  <div class="responsive-table">
    <table class="table invoice-data-table white border-radius-4 pt-1" id="" style="width:100%">
      <thead>
        <tr>
			
          <th class="all">@lang('locale.idSend')</th>         
          <th class="all">@lang('locale.creative')</th>
          <th class="all">@lang('locale.Isp')</th>
          <th class="all">@lang('locale.offer')</th>
          <th class="all">@lang('locale.from')</th>
          <th class="all">@lang('locale.subj')</th>
          <th class="all">@lang('locale.MixedsLists')</th>
          <th class="none"></th>
					  		  										
        </tr>		
      </thead>
      <tbody>
        <tr>
			
          <td></td>                  
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
            
        </tr>

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