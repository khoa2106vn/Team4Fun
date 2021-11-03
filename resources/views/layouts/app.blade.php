<!DOCTYPE html>
<html>

<head>
	<title>4Kids</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/laser_header.css') }}">
	<link rel="stylesheet" href="css/sidebar.css">

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
		<div class="bg-white p-6 rounded-lg">
			Notification
		</div>
	</div>
	<div class="">
	@yield('content')
	</div>
</body>

</html>