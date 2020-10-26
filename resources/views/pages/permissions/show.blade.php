@extends('layouts.contentLayoutMaster')
@section('title')
    {{ trans('global.permission.title_singular') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item "><a href="/">{{ trans('global.home') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('global.permission.title_singular') }}</li>
    <li class="breadcrumb-item "><a href="/documentation" class="text-black-50"><i class="fas fa-question-circle"></i></a></li>
@endsection
@section('content')

<div class="sidebar-left sidebar-fixed" style="padding-bottom: 25px;padding-top: 25px;">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mode_edit</i>@lang('locale.Permission')
          </h5>
        </div>
      </div>  
    </div>
  </div>
</div>	
<div class="col s12 m12 l12">
      <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">@lang('locale.Edit') @lang('locale.Permission')</h4>
		  @if ($errors->any())
								<div class="alert alert-danger">
									<strong>Warning!</strong> Please check input field code<br><br>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        @lang('locale.detaillePermission')
                    </th>

                    <td>
                        {{ $permission->name }}
                    </td>
					<td>
                        {{ $permission->description }}
                    </td>
					<td>
                        {{ $permission->slug }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
	<div class="row">
				<div class="input-field col s12">
					<a class="waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-4 mr-1 mb-2 left"  href="{{ route('permissions.index') }}">@lang('locale.Retour')
						<i class="material-icons right">keyboard_return</i>
					</a>
				</div>
											
	</div>
  </div>
    </div>
</div>
@endsection