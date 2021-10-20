@extends('layouts.app')

@section('content')
	@auth
		<link rel="stylesheet" href="../fontawesome/css/all.css" >
		<link rel="stylesheet" href="css/sidebar.css">
		<div class="sidenav">
			<div class="items-center effect-six">
				<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
				<a href="{{ route('users.posts', Auth::user()) }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
				<a href="#"> <i class="far fa-images"></i> Pictures</a>
				<a href="#"> <i class="fas fa-user-friends"></i> Friends</a>
				<a href="#"> <i class="fas fa-comment-alt"></i> Chat</a>
			</div>
		</div>
	@endauth
	<div class="flex justify-center mb-8 ">
		<div class="w-2/4 bg-white p-6 rounded-lg">
			@auth
				<form action="{{ route('posts') }}" method="post" class="mb-4" onsubmit="initBurst()" >
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					
					<div class="mb-4" >
						<label for="body" class="sr-only">Body</label>
						<textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
						@error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

						@error('body')
							<div class="text-red-500 mt-2 text-sm">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div>
						<link rel="stylesheet" href="css/button.css">
						<button type="submit" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest float-right">Post!</button>

					</div>

				</form>

			@endauth

			@if ($posts->count())

				@foreach ($posts as $post)
					<x-post :post="$post"/>
				@endforeach
				{{ $posts->links() }}

			@else
				<p>There are no posts!</p>
			@endif

		</div>
	</div>
@endsection