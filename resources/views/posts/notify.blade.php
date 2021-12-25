@extends('layouts.app')

@section('content')
@auth

<div class="sidenav">
	<div class="items-center effect-six">
		<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
		<a href="{{ route('users.posts', Auth::user()) }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
		<a href="{{ route('notify') }}"> <i class="fas fa-bell"></i> Notifies</a>
	</div>
</div>
@endauth
<div class="sidenav text-center pr-8" style="margin-left: 77%; background-color: white; width: 11%">
	<div class="items-center effect-six">
		<a href="" style="color:black"><i class="fas fa-poll-h text-3xl" style="margin-right: 4%;"></i>Trending</a>
		<a href="" style="color:black; text-decoration: underline;"> #Vietnam</a>
		<a href="" style="color:black; text-decoration: underline;"> #Covid</a>
		<a href="" style="color:black; text-decoration: underline;"> #Music</a>
		<a href="" style="color:black; text-decoration: underline;"> #Food</a>
		<a href="" style="color:black; text-decoration: underline;"> #Travel</a>
		<a href="" style="color:black; text-decoration: underline;"> #Hotel</a>
		<a href="" style="color:black; text-decoration: underline;"> #Games</a>
		<a href="" style="color:black; text-decoration: underline;"> #Car</a>
	</div>
</div>
<div class="flex justify-center">


	<div class="w-2/4 bg-white p-6 rounded-lg">
		<div class=" ml-2" style="width:90%">
			@if ($posts->count())

			@foreach ($posts as $post)
			<x-notify :post="$post" />
			@endforeach
			{{ $posts->appends([ 'search' => request()->query('search') ])->links() }}

			@else
			<p>Can't find any posts!</p>
			@endif
		</div>
	</div>
</div>
@endsection

