<!DOCTYPE html>
<html>
    <head>
        <title>4Kids</title>
		
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/laser_header.css') }}">
		<link rel="stylesheet" href="css/sidebar.css">
    </head>
    <body class="bg-blue-300">
		
		<nav class="p-6 bg-white flex justify-between mb-6">
			
			<ul class="flex items-center">
				<li>
					<a href="{{ route('posts') }}" class="font-bold text-xl">4KIDS</a>
				</li>
				<li>
					<a href="{{ route('posts') }}" class="p-3">Home</a>
				</li>
			</ul>
			
			<ul class="flex items-center">
			@auth
				<li>
					<i class="far fa-user"></i>
				</li> 
				<li>
					<a href="{{ route('profile') }}" class="p-3">{{ auth()->user()->name }}</a>
				</li>
				<li>
					<form action="{{ route('logout') }}" method="post" class="p-3 inline">
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
        @yield('content')
    </body>
</html>
