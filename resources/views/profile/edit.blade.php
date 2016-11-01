@extends('layout.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<form action="" method="POST" role="form">			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" placeholder="Enter First Name.." name="first_name" value="{{ Auth::user()->first_name ? : Request::old('first_name') }}">
							@if($errors->has('first_name'))
								<div class="help-block">
									{{$errors->first('first_name')}}
								</div>
							@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" id="last_name" placeholder="Enter Last Name.." name="last_name" value="{{ Auth::user()->last_name ? : Request::old('last_name') }}">
							@if($errors->has('last_name'))
								<div class="help-block">
									{{$errors->first('last_name')}}
								</div>
							@endif
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
							<textarea name="location" id="inputLocation" class="form-control" rows="3" placeholder="Enter location..">{{ Auth::user()->location ? : Request::old('location') }}</textarea>
							@if($errors->has('location'))
								<div class="help-block">
									{{$errors->first('location')}}
								</div>
							@endif
						</div>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token()}}">
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-md-4">
			
		</div>
	</div>
@stop