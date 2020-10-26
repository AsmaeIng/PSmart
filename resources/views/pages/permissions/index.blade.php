{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Permission')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/select.dataTables.min.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/data-tables.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section section-data-tables">

  <!-- DataTables example -->
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="button-trigger" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.ListePermission')</h4>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
				<div class="filter-btn">
					<a href="{{asset('permissions/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						<i class="material-icons">add</i>
						<span class="hide-on-small-only">@lang('locale.NewPermission' ) </span>
						
					</a>
				</div>			
				</div>
				<div class="col m4 s12"></div>
			</div>
		</div>
	  </div>
	</div>
 </div>

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Page Length Options</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th><center>@lang('locale.Title') </center></th>
                    <th><center>Description </center></th>
                    <th><center>Action </center></th>

                  </tr>
                </thead>
                <tbody>
					@foreach ($permissions as $permission)
                  <tr>
                    <td><center>{{ $permission->name }}</center></td>
                    <td><center>{{ $permission->description }}</center></td>
                    <td><center>
						<div class="invoice-action">					
							<a href="{{ route('permissions.show',$permission->id) }}" class="invoice-action-view" target="_blank"><i class="material-icons">remove_red_eye</i></a>
							<a href="{{ route('permissions.edit',$permission->id) }}" class="invoice-action-edit"><i class="material-icons">edit</i></a>
							<a href="{{ route('permissions.destroy',$permission->id) }}" class="invoice-action-delete"><i class="material-icons">delete_forever</i></a>
							
						</div></center>
					</td>
                  </tr>
					@endforeach
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/dataTables.select.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/data-tables.js')}}"></script>
@endsection