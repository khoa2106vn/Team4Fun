@extends('layouts.app')

@section('content')
@auth
<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />
<link rel="stylesheet" href="../fontawesome/css/all.css">
<link rel="stylesheet" href="css/sidebar.css">
<div class="sidenav">
	<div class="items-center effect-six">
		<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
		<a href="{{ route('users.posts', Auth::user()) }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
		<a href="#"> <i class="far fa-images"></i> Pictures</a>
		<a href="#"> <i class="fas fa-user-friends"></i> Friends</a>
		<a href="#"> <i class="fas fa-comment-alt ml-1"></i> Chat</a>
	</div>
</div>
@endauth
<div class="flex justify-center mb-8 ">
	<div class="w-2/4 bg-white p-6 rounded-lg">
		<div class="mb-16">
			@auth
			<form action="{{ route('posts') }}" method="post" enctype="multipart/form-data" class="mb-4" onsubmit="initBurst()">

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
				<div class="float-right flex items-center">
					<div class=" inline-block mr-2">
						<label class=" w-full flex flex-col items-center px-2 py-2 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150">
							<i class="fas fa-cloud-upload-alt fa-3x" style="font-size: 15px"></i>
							<span class="mt-2 leading-normal" style="font-size:13px">Select a file</span>
							<input type="file" class="hidden" name="image"/>
					</div>
					<div class="inline-block">
						<link rel="stylesheet" href="css/button.css">
						<button type="submit" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest">Post!</button>

					</div>
				</div>

			</form>
		</div>
		@endauth
		<div class="" style="width:95%">
			@if ($posts->count())

			@foreach ($posts as $post)
			<x-post :post="$post" />
			@endforeach
			{{ $posts->links() }}

			@else
			<p>There are no posts!</p>
			@endif
		</div>
	</div>
</div>
@endsection