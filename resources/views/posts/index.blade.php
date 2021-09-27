@extends('layouts.app')

@section('content')
	<div class="flex justify-center">
		<div class="w-8/12 bg-white p-6 rounded-lg">
			@auth
				<form action="{{ route('posts') }}" method="post" class="mb-4" onsubmit="initBurst()" >
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					
					<div class="mb-4" >
						<label for="body" class="sr-only">Body</label>
						<textarea name="body" id="body" cols="30" rows="4" class="bg-gray=100 border-2 w-full p-4 rounded-lg 
						@error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

						@error('body')
							<div class="text-red-500 mt-2 text-sm">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div>
						

						<!-- <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-medium hover:bg-red-700
						font-bold float-right">Post</button> -->



						<script async src="https://www.googletagmanager.com/gtag/js?id=UA-186875127-1"></script>
							<script>
							window.dataLayer = window.dataLayer || [];
							function gtag(){dataLayer.push(arguments);}
							gtag('js', new Date());

							gtag('config', 'UA-186875127-1');
							</script><link rel="stylesheet" href="css/style.css">


							<!-- partial:index.partial.html -->
							<button id="button" class="ready submit float-right" onclick="clickButton();" type="submit">
							
							<div class="message submitMessage">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 12.2">
								<polyline stroke="currentColor" points="2,7.1 6.5,11.1 11,7.1 "/>
								<line stroke="currentColor" x1="6.5" y1="1.2" x2="6.5" y2="10.3"/>
								</svg> <span class="button-text">Post!</span>
							</div>
							
							
							<div class="message loadingMessage">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 17">
								<circle class="loadingCircle" cx="2.2" cy="10" r="1.6"/>
								<circle class="loadingCircle" cx="9.5" cy="10" r="1.6"/>
								<circle class="loadingCircle" cx="16.8" cy="10" r="1.6"/>
								</svg>
							</div>
							
							<div class="message successMessage">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 11">
								<polyline stroke="currentColor" points="1.4,5.8 5.1,9.5 11.6,2.1 "/>
								</svg> <span class="button-text">Success</span>
							</div>
							</button>

						<canvas id="canvas"></canvas>
								<!-- partial -->
						<script  src="js/script.js"></script>



					</div>

				</form>

			@endauth

			@if ($posts->count())
				@foreach ($posts as $post)
					<div class="mb-4">
						<a href="" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray=600 text-sm">
							{{ $post->created_at->diffForHumans() }}</span>
						<p class="mb-2">{{ $post->body }}</p>
						
						<div class="flex items-center">

							@auth

								@if (!$post -> likedBy(auth()->user()))

								<form action ="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

									<input type="hidden" name="_token" value="{{ csrf_token() }}" />

									<button type="submit" class="text-blue-500">Like</button>
								</form>
								@else
								<form action ="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

									<input type="hidden" name="_token" value="{{ csrf_token() }}" />
									
									@method('DELETE')

									<button type="submit" class="text-blue-500">Unlike</button>
								</form>
								@endif

							@endauth

							<span class="text-green-500">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
						</div>

					</div>
				@endforeach
				{{ $posts->links() }}
			@else
				<p>There are no posts!</p>
			@endif

		</div>
	</div>
@endsection