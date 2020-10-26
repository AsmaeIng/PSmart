{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Email')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/quill/quill.snow.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-email.css')}}">
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
{{-- page content --}}
@section('content')
<!-- Sidebar Area Starts -->
<div  ng-app="employeesApp" ng-controller="employeesController">

<div class="email-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mail_outline</i> Mailbox</h5>
          <div class="row valign-wrapper mt-10 pt-2">
            <div class="col s3 media-image">
              <img src="/{{Auth::user()->path}}" alt="" class="circle z-depth-2 responsive-img">
              <!-- notice the "circle" class -->
            </div>
            <div class="col s9">
              <p class="m-0 subtitle font-weight-700">{{Auth::user()->username}} {{Auth::user()->lastname}}</p>
              <p class="m-0 text-muted">{{Auth::user()->email}}</p>
            </div>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft">
        <div class="sidebar-list-padding app-sidebar sidenav" id="email-sidenav">
          <ul class="email-list display-grid">
            <li class="sidebar-title">Folders</li>
            <li ><a href="{{asset('app-email')}}" class="text-sub"><i class="material-icons mr-2"> mail_outline </i>  Inbox&nbsp;&nbsp;@if($numberOfMessages>0)<span class="badge chip lighten-5 red red-text">{{$numberOfMessages}}</span>@endif</a>
            </li>
            <!--<li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> description </i> Draft</a>
            </li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> info_outline </i> Span</a>
            </li> -->  
            <li ><a href="{{asset('deleted')}}" class="text-sub"><i class="material-icons mr-2"> delete </i> Trash</a></li>
            <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> info_outline </i> Span</a></li>
            <li class="sidebar-title">Filters</li>
            <li><a href="{{asset('starred')}}" class="text-sub"><i class="material-icons mr-2"> star_border </i> Starred</a></li>
            <li class="active"><a href="{{asset('important')}}" class="text-sub"><i class="material-icons mr-2"> label_outline </i> Important</a></li>
            <li class="sidebar-title">Labels</li>
            <li><a href="#!" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Note</a></li>
            <li><a href="#!" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Paypal</a></li>
            <li><a href="#!" class="text-sub"><i class="light-green-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Invoice</a></li>
          </ul>
        </div>
      </div>
      <a href="#" data-target="email-sidenav" class="sidenav-trigger hide-on-large-only"><i
          class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->
<div class="app-email">
	<div class="content-area content-right">
		<div class="app-wrapper">
			<div class="app-search">
				<i class="material-icons mr-2 search-icon">search</i>
				<input type="text" placeholder="Search Mail" class="app-filter" id="email_filter">
			</div>
			<div class="card card card-default scrollspy border-radius-6 fixed-width">
				<div class="card-content p-0 pb-2">
					<div class="email-header">
						<div class="left-icons">
							<span class="header-checkbox">
								<label>
								  <input type="checkbox" onClick="toggle(this)" />
								  <span></span>
								</label>
							</span>
							<span class="action-icons">
								<button ng-click="refreshStarred()"><i class="material-icons">refresh</i></button>
								<button data-toggle="modal" data-target="#sendEmail"> <i class="material-icons">mail_outline</i></button>
								<i class="material-icons">folder_open</i>
								<i class="material-icons">info_outline</i>
								<button ng-click="starredSentMail()" ng-if="checkForStarred"><i class="material-icons">star_border</i></button>
								<button ng-click="importantSentMail()" ng-if="checkForImportant"><i class="material-icons">label_outline</i></button>
								<button ng-click="deleteSentMail()" ng-if="checkForDelete"><i class="material-icons delete-mails">delete</i></button>
							</span>
						</div>
						<div class="list-content"></div>
						<div class="email-action">
							<span class="email-options"><i class="material-icons grey-text">more_vert</i></span>
						</div>
					</div>
					<div class="collection email-collection">
		 
						@foreach($getImportant as $important)
							<div class="email-brief-info collection-item animate fadeUp delay-1">
								<div class="list-left">
									<label>
										<input type="checkbox"  type="checkbox" name="inbox_ids[]" ng-click="fillArrayWithMailsToDelete(<?php echo $important->inbox_id; ?>)" />
										<span></span>
									</label>
									<div class="favorite">							
										@if($important->starred == 1)
											<a name="inbox_ids[]" ng-click="fillArrayWithMailsToStarred(<?php echo $important->inbox_id; ?>)"><i class="material-icons amber-text">star_border</i></a>
										@elseif($important->starred == 0)
											<a name="inbox_ids[]" ng-click="fillArrayWithMailsToStarred(<?php echo $important->inbox_id; ?>)"><i class="material-icons">star_border</i></a>
										@endif
									</div>
									<div class="email-label">
										<a  name="inbox_ids[]" ng-click="fillArrayWithMailsToImportant(<?php echo $important->inbox_id; ?>)"><i class="material-icons amber-text">label_outline</i></a>
									</div>
								</div>
								<a class="list-content" href="app-email/content/{{$important->inbox_id}}"> 
									<div class="list-title-area">
										<div class="user-media">
											<img src="/{{$important->path}}" alt="" class="circle z-depth-2 responsive-img avtar">
											<div class="list-title">{{$important->username}} {{$important->lastname}}</div>
												@if($important->from_user_id == Auth::user()->id)
													  You
												@else
													  {{$important->username}} {{$important->lastname}}
												@endif
										</div>
									  
										<div class="title-right">
											<span class="attach-file">
											  <i class="material-icons">attach_file</i>
											</span>
											<span class="badge grey lighten-3"><i class="purple-text material-icons small-icons mr-2">
												fiber_manual_record </i>Note
											</span>
										</div>
									</div>
									<div class="list-desc">{{$important->subject}} : {{$important->message}}</div>
								 </a>
								<div class="list-right">
									<div class="list-date"> {{$important->updated_at->diffForHumans()}} </div>
								</div>
							</div>
						@endforeach
						{{$getImportant->links()}}


				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Content Area Ends -->

<!-- Add new email popup -->
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-shadow compose-email-trigger" href="#">
    <i class="material-icons">add</i>
  </a>
</div>
<!-- Add new email popup Ends-->

<!-- email compose sidebar -->
<div class="email-compose-sidebar" id="sendEmail">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title">NEW MESSAGE</h3>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form class="edit-email-item mt-10 mb-10" method="POST" action="/sendMail" enctype="multipart/form-data">
	 @csrf <!-- {{ csrf_field() }} -->
        <div class="input-field">
          <input type="email" name="email" class="edit-email-item-title validate" id="edit-item-from" value="{{ Auth::user()->email}}"
            disabled>
          <label for="edit-item-from">From</label>
        </div>
        <div class="input-field">
          <input type="email" name="to_user_id" class="edit-email-item-date" id="edit-item-to">
          <label for="edit-item-to">To</label>
        </div>
        <div class="input-field">
          <input type="text" name="subject" class="edit-email-item-date" id="edit-item-subject">
          <label for="edit-item-subject">Subject</label>
        </div>
        <div class="input-field">
          <input type="email" class="edit-email-item-date" id="edit-item-CC">
          <label for="edit-item-CC">CC</label>
        </div>
        <div class="input-field">
          <input type="email" class="edit-email-item-date" id="edit-item-BCC">
          <label for="edit-item-BCC">BCC</label>
        </div>
        <!-- Compose mail Quill editor -->
        <div class="input-field">
          <div class="snow-container mt-2">
            <div class="compose-editor"></div>
            <div class="compose-quill-toolbar" name="message">
              <span class="ql-formats mr-0">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-link"></button>
                <button class="ql-image"></button>
              </span>
            </div>
          </div>
		  <input type="hidden" name="idCreative" id="idCreative"/>
        </div>
        <div class="file-field input-field">
			<div class="btn btn-file">
				<span>Attach File</span>
				<input type="file"  name="file[]" multiple accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" id="file" name="file" type="text" placeholder="Upload one or more files">
			</div>
				@if ($errors->has('file'))
					@foreach ($errors->get('file') as $error)
						<span class="invalid-feedback" role="alert">
							<strong>{{ $error }}</strong>
						</span>
					@endforeach
				@endif
		</div>	
      
      <div class="card-action pl-0 pr-0 right-align">
        <button type="reset" class="btn-small waves-effect waves-light cancel-email-item mr-1">
          <i class="material-icons left">close</i>
          <span>Cancel</span>
        </button>
        <button class="btn-small waves-effect waves-light" type="submit" name="action">
          <i class="material-icons left">send</i>
          <span>Send</span>
        </button>
      </div>
	  </form>
      <!-- form start end-->
    </div>
  </div>
</div>
</div>
@endsection
<script src="{{ asset('js/angular/employees.js') }}"></script>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $("#deleteButton").click(function (event) {
            var x = confirm("Are you sure you want to delete?");
            if (x) {
                return true;
            }
            else {

                event.preventDefault();
                return false;
            }

        });
		$("#starredButton").click(function (event) {
            var x = confirm("Are you sure you want to starred?");
            if (x) {
                return true;
            }
            else {

                event.preventDefault();
                return false;
            }

        });
		
		$("#ImportantButton").click(function (event) {
            var x = confirm("Are you sure you want to Important?");
            if (x) {
                return true;
            }
            else {

                event.preventDefault();
                return false;
            }

        });
    </script>
{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/sortable/jquery-sortable-min.js')}}"></script>
<script src="{{asset('vendors/quill/quill.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/app-email.js')}}"></script>
@endsection