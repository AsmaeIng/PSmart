{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Role')

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
          <h4 class="card-title">@lang('locale.ListeRole')</h4>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
				<div class="filter-btn">
					<a href="{{asset('roles/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						<i class="material-icons">add</i>
						<span class="hide-on-small-only">@lang('locale.NewRole' )</span>
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
          <h4 class="card-title">Permissions end Role</h4>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="table display">
                <thead>
                  <tr>
                    <th class="all"><center>@lang('locale.Title')</center></th>
                    <th class="all"><center>Description</center></th>
                    <th class="none"><center>@lang('locale.Permissions'):  </center></th>
                    <th class="all"><center>Action</center></th>

                  </tr>
                </thead>
                <tbody>
					@foreach ($roles as $role)
                  <tr>
                    <td><center>{{ $role->name }}</center></td>
                    <td><center>{{ $role->slug }}</center></td>
                    <td>
						<div class="row">	
							<div class="input-field col  s12 "  ><strong>
								@foreach($role->permissions as $id => $permissions)
									{{ $permissions->name }} ,
								@endforeach 
							</strong></div>
					</td>
                    <td><center>
						<div class="invoice-action">					
							<a href="{{ route('roles.editRolePrermission',$role->id) }}" class="invoice-action-edit">
								<i class="material-icons">edit</i>
							</a>
							<a href="{{ route('roles.delete',$role->id) }}" class="invoice-action-edit">
								<i class="material-icons">delete_forever</i>
							</a>
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