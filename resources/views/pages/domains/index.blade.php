{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Domains')

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
          <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">attach_file</i>@lang('locale.Domain')</h4></center>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
					<div class="filter-btn">
						 <a href="{{asset('domains/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						  <i class="material-icons">add</i>
						  <span class="hide-on-small-only">@lang('locale.NewDomain' )</span>
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
    <table class="table invoice-data-table white border-radius-4 pt-1" id="domaine" style="width:100%">
      <thead>
        <tr>
			 <!-- data table responsive icons -->
			<th></th>
			  <!-- data table checkbox-->
			<th></th> 
			<th >
				<span>@lang('locale.Name')#</span>
			</th>
			<th>@lang('locale.SaleDate')</th>
			<th>@lang('locale.ExpirationDate')</th>
			<th>@lang('locale.Provider')</th>          
			<th>Edit</th>
			<th>Delete</th>
			<th></th>
        </tr>
      </thead>

      <tbody>
	  @foreach ($data as $domain)
        <tr>
			<td></td>
			<td></td>
			<td>
				<a href="https://{{ $domain->name }}">{{ $domain->name }}</a>
			</td>
			<td><span class="invoice-amount">{{ $domain->saleDate }}</span></td>
			<td><small>{{ $domain->expirationDate }}</small></td>
			<td>
				@foreach($providers as $provider)	
					@if (@$domain->provider_id===$provider->id)
						<span class="invoice-customer">{{ $provider->name }}</span>
					@endif
				@endforeach
			</td>
			<td>
				<a href="{{ route('domains.edit',$domain->id) }}" class="invoice-action-edit">
					<i class="material-icons">edit</i>
				</a>
			</td>
			<td>
				<a href="{{ route('domains.delete',$domain->id) }}" class="invoice-action-delete">
					<i class="material-icons">delete_forever</i>
				</a>
			</td>
			<td></td>
        </tr>
		@endforeach
        </tbody>
    </table>
  </div>
</section>
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