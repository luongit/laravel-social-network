@extends('layout.default')

@section('content')
	<div class="col-md-8">
		<form action="{{ route('status.post') }}" method="POST" role="form">
			<div class="form-group{{ $errors->has('status	') ? ' has-error' : '' }}">
				<textarea name="status" id="status" class="form-control" rows="2" placeholder="What' s up {{Auth::user()->getFirstNameOrUsername() }} ?"></textarea>
				@if($errors->has('status'))
					<div class="help-block">{{ $errors->first('status') }}</div>
				@endif
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
			<button type="submit" class="btn btn-default">Update status</button>
		</form>
		<div class="clearfix"></div>
		
		@include('status.status-media')
	</div>
	<div class="col-md-4"></div>
@stop