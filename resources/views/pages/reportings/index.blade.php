{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Reportings')

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
@endsection

{{-- page content --}}
@section('content')
<!-- invoice list -->
<section class="invoice-list-wrapper section">
  <!-- create invoice button-->
  <!-- Options and filter dropdown button-->
  <div class="filter-btn">
     <a href="{{asset('reportings/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
      <i class="material-icons">add</i>
      <span class="hide-on-small-only">@lang('locale.Newreporting' )</span>
    </a>
  </div>
  <div class="responsive-table">
    <table class="table invoice-data-table white border-radius-4 pt-1">
      <thead>
        <tr>
			<!-- data table responsive icons -->
			<th></th>
			<!-- data table checkbox -->
			<th></th>
			<th>
				<span>@lang('locale.ISP')#</span>
			</th>
			<th>@lang('locale.NumberSeeds')</th>
			<th>@lang('locale.MarkAsReadSpam')</th>
			<th>@lang('locale.MarkAsReadIndex')</th>
			<th>@lang('locale.Move')</th>
			<th>@lang('locale.MarkAsFlagged')</th>			
			<th>Action</th>			
        </tr>
      </thead>

      <tbody>
	  @foreach ($data as $reporting)
        <tr>
			<td></td>
			<td></td>
			<td>
				<a >{{ $reporting->NameIs }}</a>
			</td>
			<td>
				<a >{{ $reporting->NumberReportl }}</a>
			</td>
			<td>
				@if($reporting->spam == 'on')
				<span class="invoice-customer">Is Spam</span>
				@elseif($reporting->spam =='NULL' or $reporting->spam =='')
				<span class="invoice-customer">Not Spam</span>
				@endif
			</td>
			<td>
				@if($reporting->toindex == 'on')
				<span class="invoice-customer">Is Index</span>
				@elseif($reporting->toindex =='NULL' or $reporting->toindex =='')
				<span class="invoice-customer">Not Index</span>
				@endif
			</td>
			<td>
				@if($reporting->move == 'on')
				<span class="invoice-customer">Move</span>
				@elseif($reporting->move =='NULL' or $reporting->move =='')
				<span class="invoice-customer">don't Move</span>
				@endif
			</td>
			<td>
				@if($reporting->mark == 'on')
				<span class="invoice-customer">Is Mark</span>
				@elseif($reporting->mark =='NULL' or $reporting->mark =='')
				<span class="invoice-customer">Not Mark</span>
				@endif
			</td>
			<td colspan="3">
				<div class="invoice-action">

					<a href="{{ route('reportings.edit',$reporting->id) }}" class="invoice-action-edit">
						<i class="material-icons">edit</i>
					</a>
					<a href="{{ route('reportings.delete',$reporting->id) }}" class="invoice-action-delete">
						<i class="material-icons">delete_forever</i>
					</a>
				</div>
			</td>			
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