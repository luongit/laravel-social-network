@if($statuses->count())
	@foreach($statuses as $status)
	<?php if(!isset($authUserIsFriend)) :
		$authUserIsFriend = Auth::user()->isFriendWith($status->user);
	endif ?>
		<div class="media">
			<a class="pull-left" href="{{ route('profile.index',['username'=>$status->user->username]) }}">
				{{ $status->user->getavatarUrl() }}
			</a>
			<div class="media-body">
				<h4 class="media-heading">
					<a class="pull-left" href="{{ route('profile.index',['username'=>$status->user->username]) }}">
						{{ $status->user->getNameOrUsername() }}
					</a>
				</h4>
				<div class="clearfix"></div>
				<div class="body">
					{{ $status->body }}
					<ul class="list-inline">
						<li>{{ $status->created_at->diffForHumans() }}</li>
						@if($status->user->id !== Auth::user()->id)
						<li><a href="{{ route('status.like',['statusid'=>$status->id]) }}" title="">like</a></li>
						@endif
						<li>{{ $status->likes->count() }} {{ str_plural('like',$status->likes->count()) }}</li>
					</ul>
				
					@foreach($status->replies as $reply)
					<div class="media mt-2">
						<a class="pull-left" href="{{ route('profile.index',['username'=>$reply->user->username]) }}">
							{{ $reply->user->getavatarUrl() }}
						</a>
						<div class="media-body">
							<h4 class="media-heading">
								<a class="pull-left" href="{{ route('profile.index',['username'=>$reply->user->username]) }}">
									{{ $reply->user->getNameOrUsername() }}
								</a>
							</h4>
							<div class="clearfix"></div>
							<div class="body">
								{{ $reply->body }}
							</div>
							<ul class="list-inline">
								<li>{{ $reply->created_at->diffForHumans() }}</li>
								@if($reply->user->id !== Auth::user()->id)
								<li><a href="{{ route('status.like',['statusid'=>$reply->id]) }}" title="">like</a></li>
								@endif
								<li>{{ $reply->likes->count() }} {{ str_plural('like',$reply->likes->count()) }}</li>
							</ul>
						</div>
					</div>
					<!-- media -->
					@endforeach
					@if($authUserIsFriend || Auth::user()->id == $status->user->id)
						<form action="{{ route('status.reply',['statusid'=>$status->id]) }}" method="POST" role="form">
							<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error' : '' }}">
								<textarea name="reply-{{ $status->id }}" id="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
								@if($errors->has("reply-{$status->id}"))
									<div class="help-block">{{ $errors->first("reply-{$status->id}") }}</div>
								@endif
							</div>
							<input type="hidden" name="_token" value="{{ Session::token() }}">
							<button type="submit" class="btn btn-default">Reply</button>
						</form>
						<!-- end form -->
					@else
						<p>To reply you mutch add this friend & this friend accept </p>
					@endif
				</div>
			</div>
		</div>
		<!-- media -->
	@endforeach
	{{ $statuses->render() }}
@else
	<div class="alert alert-info">
		Không có comment nào trong timeline 
	</div>
@endif