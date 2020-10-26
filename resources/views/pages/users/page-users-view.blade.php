{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection
{{-- page content  --}}
@section('content')
<!-- users view start -->
<div class="section users-view">
  <!-- users view media object start -->
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m7">
        <div class="display-flex media">
          <a href="#" class="avatar">
		   @foreach($images as $log)	
				@if (@$user->id===$log->user_id)
					<img src="/{{$log->path}}" alt="log->name" class="z-depth-4 circle" height="64" width="64">
				@endif
			@endforeach			  
		  </a>
          <div class="media-body">
            <h6 class="media-heading">
              <span class="users-view-name">{{$user->username}} </span>
              <span class="grey-text">@</span>
              <span class="users-view-username grey-text">{{$user->name}}</span>
            </h6>
            <span>ID:</span>
            <span class="users-view-id">{{$user->id}}</span>
          </div>
        </div>
      </div>
      <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
        <a href="{{asset('app-email')}}" class="btn-small btn-light-indigo"><i
            class="material-icons">mail_outline</i></a>
        <!--<a href="/user-profile-page/{{ $user->id }}" class="btn-small btn-light-indigo">Profile</a>-->
        <a href="/page-users-edit/{{ $user->id }}" class="btn-small indigo">Edit</a>
      </div>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="row">
        <div class="col s12 m4">
          <table class="striped">
            <tbody>		
              <tr>
                <td>@lang('locale.Registered'):</td>
                <td>{{ $user->created_at }}</td>
              </tr>
              <tr>
                <td>@lang('locale.Lastactivity'):</td>
                <td class="users-view-latest-activity">{{ $user->last_seen }}</td>
              </tr>
              <tr>
                <td>@lang('locale.Verified'):</td>
                <td >{{ $user->verified }}</td>
              </tr>
              <tr>
                <td>@lang('locale.Role'):</td>
                <td > {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple', 'disabled' => 'true') ) !!} </td>
              </tr>
              <tr>
                <td>@lang('locale.Status'):</td>
                <td>  
					@if(Cache::has('is_online' . $user->id))
					   <span class="chip green lighten-5">
                             <span class="green-text">Online</span>
						</span>
                     @else
						<span class="chip red lighten-5">
                            <span class="red-text">Offline</span>
						</span>
                      @endif
				</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col s12 m8">
          <table class="responsive-table">
			
            <thead>
			   <tr>	
			    <th>Module Permission</th>
				@foreach ($rol as $role)
                <th>{{ $role->name}}</th>
				@endforeach
              </tr>
            </thead>
            <tbody>
				
				@foreach ($permissions as $permission)
				  <tr>
					
					<td >{{ $permission->name}}</td>
					@foreach ($rol as $role)
						<td>
							@foreach ($rolePermission as $rolePer)
								@if (@$rolePer->role_id===$role->id && @$rolePer->permission_id===$permission->id)
									<label>
									  <input type="checkbox" checked />
									  <span></span>
									</label>
								@endif
							@endforeach
						</td>
					@endforeach
				  </tr>
				@endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->

  <!-- users view card details start -->
  <div class="card">
    <div class="card-content">
      <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Offre: <span>125</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Email: <span>534</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">Image : <span>256</span></h6>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              <tr>
                <td>@lang('locale.Username') :</td>
                <td class="users-view-username">{{ $user->name }}</td>
              </tr>
              <tr>
                <td>@lang('locale.Name') :</td>
                <td class="users-view-name">{{ $user->username }}</td>
              </tr>
              <tr>
                <td>E-mail :</td>
                <td class="users-view-email">{{ $user->email }}</td>
              </tr>
              <tr>
                <td>Birthday:</td>
                <td class="users-view-birthda"> {{ $user->birthDate }} </td>
              </tr>

            </tbody>
          </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Adress:</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>@lang('locale.Pays') :</td>
                <td>
				@foreach($countrys as $count)										
						{{ $count->nameCont }}
				@endforeach
				
				</td>
              </tr>
              <tr>
                <td>@lang('locale.Ville') :</td>
                <td>
					@foreach($countrys as $citie)	
						{{ $citie->idCities }}
					@endforeach
				</td>
              </tr>
              <tr>
                <td>@lang('locale.Adress') :</td>
                <td>
					@foreach($countrys as $adr)
					{{ $adr->street }}
					@endforeach
				</td>
              </tr>
            </tbody>
          </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
          <table class="striped">
            <tbody>
			  <tr>
                <td>N° CIN :</td>
                <td>{{ $user->cin }}</td>
              </tr>
			  <tr>
                <td>N° CNSS :</td>
                <td>{{ $user->cnss }}</td>
              </tr>
              <tr>
                <td>@lang('locale.Age') :</td>
                <td><?php $dateNaissance = $user->birthDate; $aujourdhui = date("Y-m-d");  $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
						echo ' '.$diff->format('%y'); ?>
			  </td>
              </tr>
			  <tr>
                <td>Contact :</td>
                <td>{{ $user->tel }}</td>
              </tr>
              <tr>
                <td>Languages :</td>
                <td>
					<select class="browser-default" id="users-language-select2" name="laguage[]" multiple="multiple" size="80">								
							@if(strpos($user->laguage, 'Arabic') !== false)
							<option value="Arabic" selected >@lang('locale.Arabic')</option>
							@else
							<option value="Arabic" >@lang('locale.Arabic')</option>
							@endif
							@if(strpos($user->laguage, 'French') !== false)					
							<option  value="French" selected >@lang('locale.French')</option>
							@else
							<option value="French"  >@lang('locale.French')</option>
							@endif
							@if(strpos($user->laguage, 'English') !== false)
							<option value="English"  selected >@lang('locale.English')</option>
							@else
							<option value="English" >@lang('locale.English')</option>
							@endif
							@if(strpos($user->laguage, 'Spanish') !== false)
							<option value="Spanish" selected >@lang('locale.Spanish')</option>
							@else
							<option value="Spanish"  >@lang('locale.Spanish')</option>
							@endif
							@if(strpos($user->laguage, 'German') !== false)
							<option value="German"  selected >@lang('locale.German')</option>
							@else
							<option value="German"  >@lang('locale.German')</option>
							@endif
							@if(strpos($user->laguage, 'Russian') !== false)
							<option value="Russian"  selected >@lang('locale.Russian')</option>
							@else
							<option value="Russian"  >@lang('locale.Russian')</option>
							@endif
							@if(strpos($user->laguage, 'Itali') !== false)
							<option value="Italy"  selected >@lang('locale.Italy')</option>
							@else
							<option value="Italy" >@lang('locale.Italy')</option>
							@endif
					</select>                                 
                  </td>
              </tr> 
			 
			  
            </tbody>
          </table>
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
  <!-- users view card details ends -->

</div>


<!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/scripts/page-users.js')}}"></script>
@endsection