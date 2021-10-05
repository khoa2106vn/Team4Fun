@extends('layouts.app')

@section('content')
	<div>
		<link rel="stylesheet" href="../fontawesome/css/all.css" >
		<link rel="stylesheet" href="css/sidebar.css">
		<div class="sidenav">
			<div class="items-center">
				<a href="{{ route('profile') }}"> <i class="fas fa-id-card-alt"></i> Profile</a>
				<a href="#"> <i class="fas fa-user-friends"></i> Friends</a>
				<a href="{{ route('posts') }}"> <i class="fas fa-mail-bulk"></i> Posts</a>
				<a href="#"> <i class="fas fa-comment-alt"></i> Messengers</a>
				<a href="#"> <i class="fas fa-phone"></i> Contact</a>
			</div>
		</div>
	</div>
	<div class="flex justify-center">
		<div class="w-8/12 bg-white p-6 rounded-lg">
			Profile
		</div>
	</div>
@endsection