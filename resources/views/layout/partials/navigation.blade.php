<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Chatty</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Timeline</a></li>
				<li><a href="{{ route('friend.index') }}">Friends</a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
				<div class="form-group">
					<input type="text" name="query" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
			<!-- @if(Auth::check()) -->
				<li>
					<a href="{{ route('profile.index',['username'=>Auth::user()->username]) }}">
						{{Auth::user()->getAvatarUrl(20)}} {{ Auth::user()->getNameOrUsername() }}
					</a>
				</li>
				<li><a href="{{ route('profile.edit') }}">Profile</a></li>
				<li><a href="{{ route('auth.signout')}}">Sign out</a></li>
			<!-- @else -->
				<li><a href="{{ route('auth.signup')}}">Signup</a></li>
				<li><a href="{{ route('auth.signin')}}">Signin</a></li>
			<!-- @endif -->
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>