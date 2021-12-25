@extends('layouts.app')

@section('content')
<div class="justify-center flex">
	<p class="text-3xl bg-white p-6 rounded-lg w-3/12 mb-2 text-gray-500">Registration for Child Account</p>
</div>
<div class="flex justify-center">
	<div class="w-3/12 bg-white p-6 rounded-lg">
		<form action="{{ route('register.child_account') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />

			<div class="mb-4">
				<label for="parentsemail" class="sr-only">Parent's email</label>
				<input type="text" name="parentsemail" id="parentsemail" placeholder="Your Parent's Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror">

				@error('parentsemail')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="name" class="sr-only">Name</label>
				<input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

				@error('name')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="username" class="sr-only">Username</label>
				<input type="text" name="username" id="username" placeholder="Username" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">

				@error('username')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="email" class="sr-only">Email</label>
				<input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">

				@error('email')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="password" class="sr-only">Password</label>
				<input type="password" name="password" id="password" placeholder="Enter Password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">

				@error('password')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div class="mb-4">
				<label for="password_confirmation" class="sr-only">Repeat password</label>
				<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">

				@error('password_confirmation')
				<div class="text-red-500 mt-2 text-sm">
					{{ $message }}
				</div>
				@enderror
			</div>

			<div>
				<button type="submit" class="bg-green-500 text-white px-4 py-3 rounded font-medium w-full">
					Register
				</button>
			</div>
		</form>
	</div>
</div>
@endsection