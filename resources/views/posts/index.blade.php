@extends('layouts.app')

@section('content')
@auth
<script src="{{ asset('js/imagePreview.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />
<link rel="stylesheet" href="../fontawesome/css/all.css">
<link rel="stylesheet" href="css/sidebar.css">
<div class="sidenav">
	<div class="items-center effect-six">
		<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
		<a href="{{ route('users.posts', Auth::user()) }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
		<a></a>
	</div>
</div>
@endauth
<div class="flex justify-center">
	<div class="w-2/4 bg-white p-6 rounded-lg">
		<div class=" mb-20">
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
				<div class="flex items-center justify-center mb-5 bg-gray-100 rounded-lg hover:bg-gray-50">
					<img id="output" class="hover:bg-gray-200 transition duration-200 ease-in-out transform hover:-translate-y-1
                 hover:scale-110 rounded-lg" style="max-width:600px;"/>
				</div>
				<div class="float-right flex items-center">
					<div class=" inline-block mr-2">
						<label class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150">
							<span class="leading-normal" style="font-size:13px">Upload an image!</span>
							<input type="file" accept="image/*" class="hidden" onchange="loadFile(event)" name="image" id="myInput" />
					</div>
					<div class=" inline-block mr-2">
						<input type="reset" value="Reset" class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150 leading-normal" style="font-size:13px"
					onclick="clearFile(event)">
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
		<div class=" ml-2" style="width:90%">
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