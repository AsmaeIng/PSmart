{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Header')

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
          <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">view_compact</i>Liste Header</h4></center>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
					<div class="filter-btn">
						 <a href="{{asset('headers/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						  <i class="material-icons">add</i>
						  <span class="hide-on-small-only">@lang('locale.NewHeader' )</span>
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
    <table class="table invoice-data-table white border-radius-4 pt-1">
      <thead>
        <tr>
			<!-- data table responsive icons -->
			<th></th>
			<!-- data table checkbox -->
			<th></th>
			<th>
				<center><span>ID#</center></span>
			</th>
			<th><center>@lang('locale.Name')</center></th>
			<th><center>Code</center></th>			        			
			<th><center>@lang('locale.Show')</center></th>  
			<th><center>@lang('locale.Edit')</center></th>
			<th><center>@lang('locale.Delete')</center></th>
			<th></th>
        </tr>
      </thead>

      <tbody>
	  @foreach ($data as $header)
        <tr>
			<td></td>
			<td></td>
			<td>
				<center>{{ $header->id }}</center>
			</td>
			<td>
				<center>{{ $header->name }}</center>
			</td>
			<td>{{ $header->texte }}</td>
			
			<td>
				<center><a href="{{ route('headers.show',$header->id) }}" target="_blank" class="invoice-action-view mr-4">
					<i class="material-icons">remove_red_eye</i>
				</a></center>
			</td>
			<td>
				<center><a href="{{ route('headers.edit',$header->id) }}" target="_blank" class="invoice-action-edit">
					<i class="material-icons">edit</i>
				</a></center>
			</td>
			<td>
				<center><a href="{{ route('headers.delete',$header->id) }}"  class="invoice-action-delete">
					<i class="material-icons">delete_forever</i>
				</a></center>
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