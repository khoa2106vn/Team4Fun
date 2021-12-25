@props([
'post' => $post,
])

@php
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$pin = mt_rand(1000000, 9999999)
. mt_rand(1000000, 9999999)
. $characters[rand(0, strlen($characters) - 1)];

$name = str_shuffle($pin);
$name2 = str_shuffle($pin);
@endphp

<div x-data="{ showModal : false }" class=" mb-14 transition duration-200 ease-in-out transform
             hover:scale-105 ml-9 z-50">

    <div class="inline-block h-1 z-10">
        <a href="{{ route('users.posts', $post->user) }}">
            @if ($post->user->avatar != NULL)
            <img src="{{ asset('images/' . $post->user->avatar) }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 mr-2 rounded-full border-solid border-4 border-light-blue-500" style="width: 100px; height: 100px">
            @else
            <img src="{{ asset('images/boy.png') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 mr-2 rounded-full border-solid border-4 border-light-blue-500" style="width: 100px; height: 100px">
            @endif
        </a>
    </div>
    <div class="inline-block">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold ">{{ $post->user->name }}</a>
        <span class="ml-1">@_</span><span>{{ $post->user->username }} <i class="fas fa-heart text-green-500"></i> your post!</span>
        <p class="text-gray=600 text-sm">
            {{ $post->created_at->diffForHumans() }}

        </p>
    </div>

</div>