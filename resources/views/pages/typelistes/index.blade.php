{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Typelistes')

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
  <div class="card">
    <div class="card-content">
      <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">playlist_add_check</i>@lang('locale.Typelistes')</h4></center>
    </div>
  </div>

   

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <h4 class="card-title">Page Length Options</h4>
			<center><div class="filter-btn">
				 <a href="{{asset('typelistes/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
				  <i class="material-icons">add</i>
				  <span class="hide-on-small-only">@lang('locale.NewTypeliste' )</span>
				</a>
			</div></center>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th><center>ID</center></th>
                    <th><center><span>@lang('locale.Name')#</span></center></th>
                    <th><center>@lang('locale.Abriviation')</center></th>
                    <th><center>Edit</center></th>
                    <th><center>Delete</center></th>
                  </tr>
                </thead>
                <tbody>
					@foreach ($data as $typeliste)
						<tr>
							<td><center>{{ $typeliste->id }}</center></td>
							<td><center>{{ $typeliste->name }}</center></td>
							<td><center><span class="invoice-amount">{{ $typeliste->abriviation }}</span></center></td>
							<td><center>
								<a href="{{ route('typelistes.edit',$typeliste->id) }}" class="invoice-action-edit">
									<i class="material-icons">edit</i>
								</a></center>
							</td>
							<td><center>
								<a href="{{ route('typelistes.delete',$typeliste->id) }}" class="invoice-action-delete">
									<i class="material-icons">delete_forever</i>
								</a></center>
							</td>
						</tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th><center>ID</center></th>
                    <th><center><span>@lang('locale.Name')#</span></center></th>
                    <th><center>@lang('locale.Abriviation')</center></th>
                    <th><center>Edit</center></th>
                    <th><center>Delete</center></th>

                  </tr>
                </tfoot>
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