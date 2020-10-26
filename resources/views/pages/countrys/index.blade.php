{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Country')

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
			<center><h4 class="card-title"><i class="material-icons app-header-icon text-top">format_list_numbered</i>@lang('locale.ListeCountry')</h4></center>
				
		</div>
	  </div>
	</div>
 </div>

  <!-- Page Length Options -->
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
			<center><div class="filter-btn">
				<a href="{{asset('countrys/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
					<i class="material-icons">add</i>
					<span class="hide-on-small-only">@lang('locale.NewCountry' )</span>
				</a>
			</div></center>
          <div class="row">
            <div class="col s12">
              <table id="page-length-option" class="display">
                <thead>
                  <tr>
                    <th><center>@lang('locale.Sortname')</center></th>
                    <th><center>@lang('locale.Name')</center></th>
					<th><center>@lang('locale.Phonecode')</center></th>
                    <th><center>@lang('locale.Flag')</center></th>
                    <th><center>Action</center></th>

                  </tr>
                </thead>
                <tbody>
					@foreach ($countrys as $country)
                  <tr>
                    <td><center>{{ $country->sortname }}</center></td>
                    <td><center>{{ $country->name }}</center></td>
                    <td><center>{{ $country->phonecode }}</center></td>
                    <td>
						<center>
							@foreach($flags as $log)	
								@if (@$country->id===$log->country_id)
									<a href="/{{$log->path}}/{{$log->name}}" title="The Cleaner">
										<img src="/{{$log->path}}/{{$log->name}}" class="responsive-img" style="border-radius: 50%;" alt="{{$log->name}}">
									</a>
								@endif
							@endforeach
						</center>
					</td>
                    <td><center>
						<div class="invoice-action">					
							<a href="{{ route('countrys.edit',$country->id) }}" target="_blank" class="invoice-action-edit">
								<i class="material-icons">edit</i>
							</a>
							<a href="{{ route('countrys.delete',$country->id) }}" class="invoice-action-delete">
								<i class="material-icons">delete_forever</i>
							</a>
						</div></center>
					</td>
                  </tr>
					@endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th><center>@lang('locale.Sortname')</center></th>
                    <th><center>@lang('locale.Name')</center></th>
					<th><center>@lang('locale.Phonecode')</center></th>
                    <th><center>@lang('locale.Flag')</center></th>
                    <th><center>Action</center></th>

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