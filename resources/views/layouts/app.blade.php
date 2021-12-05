<!DOCTYPE html>
<html>

<head>
	<title>4Kids</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/laser_header.css') }}">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
	<script src="{{ asset('js/hideClick.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
	<link rel="stylesheet" href="css/button.css">
	<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
	<script src="{{ asset('js/imagePreview.js') }}"></script>
	<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />
</head>

<body class="bg-blue-200 ">

	<div class="flex justify-center">
		<nav class="p-6 bg-white flex justify-between mb-6 w-2/4 rounded-lg">

			<ul class="flex items-center">
				<li>
					<a href="{{ route('posts') }}" class="font-bold text-xl"><img src="{{ asset('images/logo4kid.png') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 hover:bg-gray-200 inline object-cover w-16 h-16 mr-2 rounded-full" style="width: auto; height: 50px"></a>
				</li>
			</ul>

			<ul class="flex items-center mt-1">
				<li>
					<div class="topnav">
						<div class="search-container">
							<form action=" {{ route('posts') }} " method="GET" class="">
								<input type="text" class=" pl-2 pr-40 py-1" name="search" placeholder="Search.." value="{{ request()->query('search') }}">
							</form>
						</div>
					</div>
				</li>
			</ul>

			<ul class="flex items-center">
				@auth
				<li class="mr-1">
					<a href="{{ route('users.posts', auth()->user()) }}">
						@if (auth()->user()->avatar != NULL)
						<img src="{{ asset('images/' . auth()->user()->avatar) }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 rounded-full border-solid border-4 border-light-blue-500" style="width: 50px; height: 50px">
						@else
						<img src="{{ asset('images/boy.png') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 rounded-full border-solid border-4 border-light-blue-500" style="width: 50px; height: 50px">
						@endif
					</a>
				</li>

				<li>
					<a href="{{ route('users.posts', Auth::user()) }}" class="p-2 text-lg hover:bg-gray-200 w-16 h-16 mr-2 rounded-full">{{ auth()->user()->name }}</a>
				</li>
				<li>
					<form action="{{ route('logout') }}" method="post" class="p-2 inline hover:bg-gray-200 w-16 h-16 mr-2 rounded-full">
						@csrf
						<button type="submit"><i class="fas fa-sign-out-alt mr-1"></i>Logout</button>
					</form>
				</li>
				@endauth

				@guest
				<li>
					<a href="{{ route('login') }}" class="p-3">Login</a>
				</li>
				<li>
					<a href=" {{ route('register') }}" class="p-3">Register</a>
				</li>
				@endguest
			</ul>

		</nav>
	</div>
	<div class="fixed w-2/12" style="margin-left:77%;">
		<div class="bg-white p-6 rounded-lg ">
			<span class="text-xl ">Feedback</span>
			<form action="{{ route('feedback') }}" method="POST" id="feedback" >
				@csrf
				<input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-2 rounded-lg 
						@error('email') border-red-500 @enderror my-2 pl-4">

				@error('email')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
				<textarea name="feedback_body" id="feedback_body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
						@error('feedback_body') border-red-500 @enderror" placeholder="Send us your feedback!"></textarea>

				@error('feedback_body')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
				<div class="inline-block">
					<button form="feedback" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest" type="submit">Submit</button>
				</div>
			</form>

		</div>
	</div>
	<div class="">
		@yield('content')
	</div>
</body>

</html>