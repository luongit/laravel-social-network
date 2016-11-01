@extends('layout.default')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-8">
					@include('user.partials.userblock')
					<div class="clearfix"></div>
					@include('status.status-media')
				</div>
				<div class="col-md-4">
					@if(Auth::user()->hasFriendRequestPedding($item))
						<input type="button" class="btn btn-sm btn-warning pull-right" name="wating-friend" value="Đã gửi lời mời kết bạn" />
					@elseif(Auth::user()->hasFriendRequestReceived($item))
					<p><a href="{{ route('friend.accept',['username'=>$item->username]) }}" class="btn btn-xs btn-primary pull-right">Chấp nhận kết bạn</a></p>
					@elseif(Auth::user()->isFriendWith($item))
					<form action="{{ route('friend.delete',['username'=>$item->username]) }}" method="POST" role="form" class="form-inline text-right">

						<input type="hidden" name="_token" value="{{ Session::token() }}">
						<input type="button" class="btn btn-sm btn-success" name="is-friend" value="Bạn bè" />
						<input type="submit" class="btn btn-sm btn-danger" name="delete-friend" value="Delete friend" />
					</form>

					@elseif(Auth::user()->id !== $item->id)
						<p><a href="{{ route('friend.add',['username'=>$item->username]) }}" class="btn btn-xs btn-primary">Add a friend</a></p>
					@else
						<input type="button" class="btn btn-sm btn-primary pull-right" name="wating-friend" value="Chính là bạn" />
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h3>{{ $item->getFirstNameOrUsername() }} 's friends</h3>
			

			@if(!$item->friends()->count())
				No friend
			@else
				@foreach($item->friends() as $item)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>
@stop