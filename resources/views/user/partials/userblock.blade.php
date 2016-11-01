<div class="media">
	<a class="pull-left" href="{{ route('profile.index',['username'=>$item->username]) }}">
		{{ $item->getAvatarUrl(40)}}
	</a>
	<div class="media-body">
		<h4 class="media-heading">{{ $item->getNameOrUsername()}}</h4>
		<p>{{$item->location}}</p>
	</div>
</div>