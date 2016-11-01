@extends('layout.default')

@section('content')
	<div class="col-md-4">
		<form action="{{ route('auth.signin')}}" method="POST" role="form">
			<h2>Signin Form</h2>
			<p>Please enter your account infomation</p>
			<div class="form-group{{ $errors->has('username	') ? ' has-error' : '' }}">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username" placeholder="Enter username here...">
				@if($errors->has('username'))
					<div class="help-block">{{ $errors->first('username') }}</div>
				@endif
			</div>
			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" placeholder="Enter password here...">
				@if($errors->has('password'))
					<div class="help-block">{{ $errors->first('password') }}</div>
				@endif
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember">
					Remember me
				</label>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
			<button type="submit" class="btn btn-primary">Signin now</button>
		</form>
	</div>
@stop