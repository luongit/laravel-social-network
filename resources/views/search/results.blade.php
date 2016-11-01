@extends('layout.default')

@section('content')
	<h2>You  have srach {{ Request::input('query')}} </h2>
	@foreach($users as $item)
	@include('user.partials.userblock')
	@endforeach
@stop