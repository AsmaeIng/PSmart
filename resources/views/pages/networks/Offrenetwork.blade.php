{{-- mainLayouts extends --}}
@extends('layouts.contentLayoutMaster')

{{-- Page title --}}
@section('title', 'Network')

{{-- main page content --}}
@section('content')

<div  name="div" class="col s12 m12 l12">
    <div class="row">
		<div class="col s12 m12 l12">
			<iframe id="iframe1" src="http://localhost/php/index.php" height="900px" width="100%">
				<p>Your browser does not support iframes.</p>
			</iframe>
		</div>   
	</div>   
</div>   
@endsection
