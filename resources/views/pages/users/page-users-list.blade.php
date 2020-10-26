{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users list')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
  href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">

@endsection

{{-- page content --}}
@section('content')
<!-- users list start -->
<section class="users-list-wrapper section">
  <div class="users-list-filter">
    <div class="card-panel">
      <div class="row">
          <form >
          <div class="col s12 m6 l3">
            <label for="users-list-verified">@lang('locale.Verified')</label>
            <div class="input-field">
              <select class="form-control" id="users-list-verified">
                <option value="">Any</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <label for="users-list-role">@lang('locale.Role')</label>
            <div class="input-field">
				<select class="form-control" id="users-list-role">
					<option value="">Any</option>
					@foreach($roles as $role)							
						<option id="{{ $role->id }}" value="{{ $role->name }}">{{ $role->name}}</option>
					@endforeach
				</select>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <label for="users-list-status">@lang('locale.Status')</label>
            <div class="input-field">
			
              <select name="status" class="form-control" id="users-list-status">
					<option value="">Any</option>
					<option value="is_online">Active</option>
					<option value="is_offline">Close</option>			
              </select>
			
            </div>
          </div>
          <div class="col s12 m6 l3 display-flex align-items-center show-btn">
            <button type="submit" class="btn btn-block indigo waves-effect waves-light">@lang('locale.Show')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <!-- datatable start -->
        <div class="responsive-table">
          <table id="users-list-datatable" class="table" style="width:100%">
            <thead>
              <tr>
                <th></th>
				<th><center>id #</center></th>
                <th><center>@lang('locale.Username')</center></th>
                <th><center>@lang('locale.Lastactivity')</center></th>
                <th><center>@lang('locale.Verified')</center></th>
                <th><center>@lang('locale.Role')</center></th>
                <th><center>@lang('locale.Status')</center></th>
                <th><center>@lang('locale.Edit')</center></th>
                <th><center>@lang('locale.View')</center></th>
				<th><center>@lang('locale.Delete')</center></th>
				<th><center>@lang('locale.settings')</center></th>
              </tr>
            </thead>
            <tbody>
			@foreach ($data as $key => $user)
              <tr>
                <td></td>
               <td><center>{{ $user->id}}</center></td>
                <td><center><a href="page-users-view/{{ $user->id }}">{{ $user->name }}</a></center></td>
                <td><center>{{ $user->last_seen }}</center></td>
                <td><center>{{ $user->verified }}</center></td>
                <td>
					  @if(!empty($user->getRoleNames()))
						@foreach($user->getRoleNames() as $v)
						<span class="chip green lighten-5">
						  <label class="green-text">{{ $v }}</label>
						</span>
						@endforeach
					  @endif
				</td>
                <td><center>
				   @if(Cache::has('is_online' . $user->id))
					   <span class="chip green lighten-5">
                             <span class="green-text">Online</span>
						</span>
                     @else
						<span class="chip red lighten-5">
                            <span class="red-text">Offline</span>
						</span>
                      @endif
					 </center>
                </td>
                <td><center><a href='page-users-edit/{{ $user->id }}' target="_blank" ><i class="material-icons">edit</i></a></center></td>
                <td><center><a href="page-users-view/{{ $user->id }}" target="_blank"><i class="material-icons">remove_red_eye</i></a></center></td>
                <td><center><a href = 'delete/{{ $user->id }}'  ><i class="material-icons">delete_forever</i></a></center></td>
                <td><center><a href = 'page-account-settings/{{ $user->id }}' target="_blank" ><i class="material-icons">settings</i></a></center></td>
              </tr>
			@endforeach
            </tbody>
			 
          </table>
        </div>
        <!-- datatable ends -->
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('js/scripts/page-users.js')}}"></script>
@endsection