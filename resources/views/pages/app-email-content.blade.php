{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Email')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/quill/quill.snow.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-email-content.css')}}">
@endsection

{{-- main page content --}}
@section('content')
<!-- Sidebar Area Starts -->
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
      <div id="sidebar-list" class="sidebar-menu list-group position-relative">
        <div class="sidebar-list-padding app-sidebar sidenav" id="email-sidenav">
          <ul class="email-list display-grid">
            <li class="sidebar-title">Folders</li>
            <li class="active">
              <a href="{{asset('app-email')}}" class="text-sub">
                <i class="material-icons mr-2">mail_outline </i>
                 Inbox&nbsp;&nbsp;@if($numberOfMessages>0)<span class="badge">{{$numberOfMessages}}</span>@endif</a>
              </a>
            </li>
            <li><a href="{{asset('sent')}}" class="text-sub"><i class="material-icons mr-2"> send </i> Sent</a></li>
            <!--<li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> description </i> Draft</a>
            </li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> info_outline </i> Span</a>
            </li> -->
            <li><a href="{{asset('deleted')}}" class="text-sub"><i class="material-icons mr-2"> delete </i> Trash</a></li>
            <li class="sidebar-title">Filters</li>
            <li><a href="{{asset('starred')}}" class="text-sub"><i class="material-icons mr-2"> star_border </i>
                Starred</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> label_outline </i>
                Important</a></li>
            <li class="sidebar-title">Labels</li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Note</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Paypal</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i
                  class="light-green-text material-icons small-icons mr-2">
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
<div class="app-email-content">
  <div class="content-area content-right">
    <div class="app-wrapper">
      <div class="app-search">
        <i class="material-icons mr-2 search-icon">search</i>
        <input type="text" placeholder="Search Mail" class="app-filter" id="email_filter">
      </div>
      <div class="card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content pt-0">
          <div class="row">
            <div class="col s12">
              <!-- Email Header -->
              <div class="email-header">
                <div class="subject">
                  <div class="back-to-mails">
                    <a href="{{asset('app-email')}}"><i class="material-icons">arrow_back</i></a>
                  </div>
                  <div class="email-title">{{$inbox_details[0]->subject}}</div>
                </div>
                <div class="header-action">
                  <span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
                      fiber_manual_record </i>Paypal</span>
                  <div class="favorite">
                    <input type="checkbox"  name="inbox_ids[]" ng-click="fillArrayWithMailsToStarred(<?php echo $inbox_details[0]->inbox_id; ?>)"><i class="material-icons">star_border</i></input>
                  </div>
                  <div class="email-label">
                    <i class="material-icons">label_outline</i>
                  </div>
                </div>
              </div>
              <!-- Email Header Ends -->
              <hr>
              <!-- Email Content -->
              <div class="email-content">
                <div class="list-title-area">
                  <div class="user-media">
						<img src="/{{$inbox_details[0]->path}}" alt="" class="circle z-depth-2 responsive-img avtar">	
                    <div class="list-title">
                      <span class="name">{{$inbox_details[0]->username}} {{$inbox_details[0]->lastname}}</span>
                      <span class="to-person">to me</span>
                    </div>
                  </div>
                  <div class="title-right">
                    <span class="mail-time">{{$inbox_details[0]->created_at->diffForHumans()}} </span>
                    <i class="material-icons">reply</i>
                    <i class="material-icons">more_vert</i>
                  </div>
                </div>
                <div class="email-desc">
                  {{$inbox_details[0]->message}}
                </div>
              </div>
              <!-- Email Content Ends -->
              <hr>
              <!-- Email Footer -->
              <div class="email-footer">
                <h6 class="footer-title">Attachments {{$numberOfAttachments}}</h6>
                <div class="footer-action">				
                  <div class="attachment-list"> 
					@foreach($inbox_attachments as $attachment)				  
						<div class="attachment">
						  <img src="/{{$attachment->path}}/{{$attachment->title}}" alt="" class="responsive-img attached-image" >
						  <div class="size">
							<span class="grey-text">{{$attachment->title}}</span>
						  </div>
						  <div class="links">
							<a href="/{{$attachment->path}}/{{$attachment->title}}" target="_blank"  class="left">
							  <i class="material-icons">remove_red_eye</i>
							</a>
							<a href="/{{$attachment->path}}/{{$attachment->title}}" download class="Right" >
							   <i class="material-icons">file_download</i>
							</a>
						  </div>
						</div>
					@endforeach				  
                  </div>
                  <div class="footer-buttons">
                    <a class="btn reply mb-1"><i class="material-icons left">reply</i><span>Reply</span></a>
                    <a class="btn forward mb-1"><i class="material-icons left">reply</i><span>Forward</span></a>
                  </div>
                </div>
                <div class="reply-box d-none">
                  <form action="/sendMail" method="POST" enctype="multipart/form-data">
				  @csrf
                      <div class="input-field col s12">
                      <div class="snow-container mt-2">
                        <div class="forward-email"></div>
                        <div class="forward-email-toolbar">
                          <span class="ql-formats mr-0">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                          </span>
                        </div>
                      </div>					    
                    </div>
					<input type="hidden" name="idCreative" id="idCreative"/>
                    <div class="input-field col s12">
                      <button class="btn reply-btn right" type="submit" name="action">Reply</button>
                    </div>
					<div class="input-field col s12">
					  <input id="subject" name="subject" type="hidden" class="validate" value="{{$inbox_details[0]->subject}}">
                      <input id="email" name="to_user_id" type="hidden" class="validate"value="{{$inbox_details[0]->email}}">
                    </div>
                  </form>
                </div>
                <div class="forward-box d-none">
                  <hr>
                  <form action="/sendMail" method="POST" enctype="multipart/form-data">
				  @csrf
                    <div class="input-field col s12">
                      <i class="material-icons prefix"> person_outline </i>
                      <input id="email" name="to_user_id" type="email" class="validate">
                      <label for="email">To</label>
                    </div>
                    <div class="input-field col s12">
                      <i class="material-icons prefix"> title </i>
                      <input id="subject" name="subject" type="text" class="validate">
                      <label for="subject">Subject</label>
                    </div>
                    <div class="input-field col s12">
                      <div class="snow-container mt-2">
                        <div class="forward-email"></div>
                        <div class="forward-email-toolbar">
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
                    <div class="input-field col s12">
                      <a type="submit" name="action" class="btn forward-btn right">Forward</a>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Email Footer Ends -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->
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
<script src="{{asset('js/scripts/app-email-content.js')}}"></script>
@endsection