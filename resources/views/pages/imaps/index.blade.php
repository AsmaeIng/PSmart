{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Imap')

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
     <a href="{{asset('imaps/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
      <i class="material-icons">add</i>
      <span class="hide-on-small-only">@lang('locale.Newimap' )</span>
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
				<center> <span>@lang('locale.ISPS')#</span></center> 
			</th>
			<th><center> @lang('locale.Email')</center> </th>
			<th><center> @lang('locale.Password')</center> </th>
			<th><center> @lang('locale.Folder')</center> </th>          
			<th><center> @lang('locale.Edit')</center> </th>
			<th><center> @lang('locale.Delete')</center> </th>
			<th></th>
        </tr>
      </thead>'

      <tbody>
	  @foreach ($imaps as $imap)
        <tr>
			<td></td>
			<td></td>
			<td>
				<center> <a >{{ $imap->NameIs }}</a></center> 
			</td>
			<td><center> <span class="invoice-amount">{{ $imap->Email }}</span></center> </td>
			<td><center> <small>{{ $imap->Password }}</small></center> </td>
			<td><center> 
					<span class="invoice-customer">
						@if($imap->Folder == '1')
							<span class="chip lighten-5 green green-text">Is INBOX</span>
						@elseif($imap->Folder =='2' )
							 <span class="chip lighten-5 red red-text">IS SPAM</span>
						@endif
					</span>
				</center> 
			</td>
			<td >
				<center> 
					<a href="{{ route('imaps.edit',$imap->id) }}" class="invoice-action-edit">
						<i class="material-icons">edit</i>
					</a>
				</center> 
			</td>
			<td>
				<center> 
					<a href="{{ route('imaps.delete',$imap->id) }}" class="invoice-action-delete">
						<i class="material-icons">delete_forever</i>
					</a>
				</center> 
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