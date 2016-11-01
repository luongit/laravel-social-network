@extends('layout.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			@if(!$friends->count())
				<div class="alert alert-info">
					You have no friend ...
				</div>
			@else
				@foreach($friends as $item)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
		<div class="col-md-4">
			<h3>Friend requests</h3>
			
			@if(!$request->count())
				No friend request
			@else
				@foreach($request as $item)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>
@stop