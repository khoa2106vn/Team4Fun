@extends('layouts.app')

@section('content')
<div>
	<link rel="stylesheet" href="../../fontawesome/css/all.css">
	<link rel="stylesheet" href="../../css/sidebar.css">
	<div class="sidenav">
		<div class="items-center">
			<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
			<a href="{{ route('users.posts', Auth::user()) }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
			<a href="#"> <i class="far fa-images"></i> Pictures</a>
			<a href="#"> <i class="fas fa-user-friends"></i> Friends</a>
			<a href="#"> <i class="fas fa-comment-alt"></i> <span class="ml-1">Chat</span></a>

		</div>
	</div>
</div>
<div class="flex justify-center">
	<div class="w-2/4">
		<div class="p-6 bg-gray-800 mb-1 rounded-lg ">
			<div class="grid justify-items-center text-center">
				<div>
					<img src="{{ asset('images/' . $user->avatar) }}" class="roundImg" style="width: 200px; height: auto">
				</div>
				<div class="">
					<h1 class="text-white text-2xl font-medium mb-1 font-bold">
					<span class="">{{ $user->name }}</span></h1>
					<p class="text-white font-semibold">This user has a total of {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}</p>

                </div>
                <div class="">
                @auth
			<form action="{{ route('post.avatar') }}" method="post" enctype="multipart/form-data" class="mb-4" onsubmit="initBurst()">

				<input type="hidden" name="_token" value="{{ csrf_token() }}" />


				<div class="float-right flex items-center">
					<div class=" inline-block mr-2">
						<label class="button button--moema px-5 py-3 bg-gray-800
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest">
							<i class="fas fa-cloud-upload-alt fa-3x" style="font-size: 15px"></i>
							<span class="mt-2 leading-normal" style="font-size:13px">Change avatar</span>
							<input type="file" class="hidden" name="image"/>
					</div>
					<div class="inline-block">
						<link rel="stylesheet" href="css/button.css">
						<button type="submit" class="button button--moema px-5 py-3 bg-gray-800
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest">Save</button>

					</div>
				</div>

			</form>
            @endauth
		</div>

			</div>
		</div>

		<div class="bg-white p-6 rounded-lg">

			@auth
				@if(Auth::user()->id == $user->id)
				<form action="{{ route('posts') }}" method="post" class="mb-4" onsubmit="initBurst()">

					<input type="hidden" name="_token" value="{{ csrf_token() }}" />

					<div class="mb-4">
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
						<link rel="stylesheet" href="../../css/button.css">
						<button type="submit" class="button button--moema px-5 py-3 bg-gray-800
							hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2
							border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest float-right">Post!</button>

					</div>

				</form>
				@endif
			@endauth

			@if ($posts->count())

			@foreach ($posts as $post)
			<x-post :post="$post" />
			@endforeach
			{{ $posts->links() }}

			@else
			<p>{{ $user->name }} does not have any posts!</p>
			@endif
		</div>
	</div>
</div>
@endsection
