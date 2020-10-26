{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Servers')

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
    <div class="row">
    <div class="col s12 m12 l12">
      <div id="button-trigger" class="card card card-default scrollspy">
        <div class="card-content">
          <center><h4 class="card-title"><i class="material-icons app-header-icon text-top">router</i>@lang('locale.Server')</h4></center>
			<div class="row">
				<div class="col m4 s12"></div>
				<div class="col m4 s12">
					<div class="filter-btn">
						<a href="{{asset('servers/create')}}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
						  <i class="material-icons">add</i>
						  <span class="hide-on-small-only">@lang('locale.NewServer' )</span>
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
    <table class="table invoice-data-table white border-radius-4 pt-1" style="width:100%">
      <thead>
        <tr>
			<!-- data table responsive icons -->
			<th></th>
			<!-- data table checkbox -->
			<th></th>
			<th class="all">
				<span>@lang('locale.Alias')#</span>
			</th>
			<th class="all">@lang('locale.SaleDate')</th>
			<th class="all">@lang('locale.ExpirationDate')</th>
			<th class="all">@lang('locale.Active')</th>
			<th class="all" >@lang('locale.USER')</th>
			<th class="all">@lang('locale.IPMain')</th>	
			<th class="none"><center></center></th>
			<th class="all">Action</th>
			
        </tr>
      </thead>

      <tbody>
	  @foreach ($data as $server)
        <tr>
			<td></td>
			<td></td>
			<td>
				<a href="https://{{ $server->ip }}">{{ $server->alias }}</a>
			</td>
			<td><span class="invoice-amount">{{ $server->saleDate }}</span></td>
			<td><small>{{ $server->expirationDate }}</small></td>
			<td>
							@if($server->active == 'on')
								<span class="chip lighten-5 green green-text">Is Active</span>
							@elseif($server->active =='NULL' or $server->active =='')
								<span class="chip lighten-5 red red-text">Not Active</span>
							@endif
			</td>
			<td>{{ $server->userName }}</td>
			<td>{{ $server->ip }}</td>
			<td>
				<div class="row">	
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.Alias') :</strong> {{$server->alias}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.SaleDate') :</strong> {{$server->saleDate}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.ExpirationDate') :</strong> {{$server->expirationDate}}</div>														
				</div>
				<div class="row">
					<div class="input-field col m4 s6 "  ><strong>SPAM/INBOX :</strong> {{$server->typeSpamInbox}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.userProviders') :</strong> {{$server->user_providers}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.passwordProviders') :</strong> {{$server->password_providers}}</div>						
				</div>
				<div class="row">
					@foreach($providers as $log)	
						@if (@$server->provider_id===$log->id)
						<div class="input-field col m4 s6 "  ><strong>@lang('locale.Provider') :</strong> {{$log->name}}</div>
						@endif
					@endforeach
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.USER') :</strong> {{$server->userName}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.password') :</strong> {{$server->password}}</div>								
				</div>	
				<div class="row">
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.IPMain') :</strong> {{$server->ip}}</div>
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.NIP') :</strong> {{$server->NIP}}</div>	
					@foreach($operatingsystems as $opera)	
						@if (@$server->OS_id===$opera->id)
						<div class="input-field col m4 s6 "  ><strong>@lang('locale.OS') :</strong> {{$opera->name}}</div>
						@endif
					@endforeach
				</div>
				<div class="row">
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.price') :</strong> {{$server->price}}</div>
					<div class="input-field col m4 s12 "  ><strong>@lang('locale.sshPort') :</strong> {{$server->sshPort}}</div>
					<div class="input-field col m4 s6 "  ><strong>panels :</strong> {{$server->panel}}</div>														
				</div>
				<div class="row">
					@foreach($domains as $dom)	
						@if (@$server->domain_id===$dom->id)
						<div class="input-field col m4 s6 "  ><strong>@lang('locale.Domain') :</strong> {{$dom->name}}</div>
						@endif
					@endforeach
					<div class="input-field col m4 s6 "  ><strong>@lang('locale.random') :</strong> {{$server->random}}</div>
					<div class="input-field col m4 s12">            
						<label style="position: inherit;">
							@if($server->active == 'on')
								<span id="active" class="chip lighten-5 green green-text" >Is Active</span>
							@elseif($server->active =='' )
								<span id="active" class="chip lighten-5 red red-text">Not Active</span>
							@endif
						</label>
					</div>					
				</div>
				<div class="row">	 					
					@if($server->active == 'on')					
						<div class="input-field col m6 s12 "  ><strong>@lang('locale.ListeISPS') :</strong> {{$server->isps}}</div>
						<div class="input-field col m6 s12 "  ><strong>@lang('locale.ListeMailers') :</strong> {{$server->mailers}}</div>
					@endif
				</div>		

			</td>
			<td>
				<div class="invoice-action">
					<a href="{{ route('servers.show',$server->id) }}" onclick="window.open(this.href);return false" class="invoice-action-view mr-4">
						<i class="material-icons">remove_red_eye</i>
					</a>
					@if ($server->domain_id==1 &&  $server->random=='')
					<a href="{{ route('servers.edit',$server->id) }}" onclick="window.open(this.href);return false" class="invoice-action-view mr-4">
						<i class="material-icons">autorenew</i>
					</a>
					@endif
					@if (!($server->domain_id==1 &&  $server->random==''))
					<a href="{{ route('servers.createAuto',$server->id) }}" onclick="window.open(this.href);return false" class="invoice-action-view mr-4">
						<i class="material-icons">autorenew</i>
					</a>
					@endif 
					
					
					<!--<a href="{{ route('servers.createAuto',$server->id) }}" onclick="window.open(this.href);return false" class="invoice-action-view mr-4">
						<i class="material-icons">autorenew</i>
					</a>-->
					
					<a href="{{ route('servers.edit',$server->id) }}" onclick="window.open(this.href);return false" class="invoice-action-edit">
						<i class="material-icons">edit</i>
					</a>
					<a href="{{ route('servers.delete',$server->id) }}" class="invoice-action-edit">
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