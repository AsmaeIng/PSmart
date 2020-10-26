<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Upload Multiple Files in Laravel 7 with Coding Driver</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />


<style>
.invalid-feedback {
  display: block;
}
</style>
</head>
<body>

<div class="container mt-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
	 <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
	  @csrf
	<div class="row">
		<div class="col m6 s12">
                       <select id="network_id" name="network_id">
								@foreach($networks as $network)							
									<option id="{{ $network->id }}" value="{{ $network->id }}">{{ $network->name}} {{ $network->id }}</option>
								@endforeach
							</select>
							<label for="Offer">@lang('locale.Offer')</label>                
                </div>
      <div class="col m6 s12">  
  
	</div>
	
	</div>
	 
   
     
      <div class="form-group">
          <input type="file" name="image" multiple class="form-control" accept="image/*">
          @if ($errors->has('logonetworks'))
            @foreach ($errors->get('logonetworks') as $error)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $error }}</strong>
            </span>
            @endforeach
          @endif
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
</div>
</body>
</html>