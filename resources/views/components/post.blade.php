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

<div x-data="{ showModal : false }" class="mb-8 transition duration-200 ease-in-out transform hover:-translate-y-1
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
        <span class="ml-1">@_</span><span>{{ $post->user->username }}</span>
        <p class="text-gray=600 text-sm">
            {{ $post->created_at->diffForHumans() }}

        </p>
    </div>

    <div class="ml-6 ">
        <!-- Modal Background -->
        <div x-show="showModal" class=" text-gray-500 flex items-center justify-center overflow-auto z-50  bg-gray-200 left-0 right-0 top-0 bottom-0 rounded-lg w-5/6 ml-20 mb-2" >
            <!-- Modal -->
            <div x-show="showModal" style="width:100%" class="m-6 bg-white rounded-xl shadow-2xl p-6 mx-10" >
                <!-- Title -->
                <span class="font-bold block text-2xl mb-3"><i class="far fa-edit"></i> Edit Post </span>

                <form action="{{ route('post.edit', $post->id) }}" method="post" enctype="multipart/form-data" class="mb-4" onsubmit="initBurst()">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{ method_field('PATCH') }}
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
						@error('body') border-red-500 @enderror" placeholder="Change your post!" >{{ $post->body }}</textarea>

                        @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center mb-5 rounded-lg hover:bg-gray-50">
                    @if ($post->image_path != NULL)
                        <image id="{{ $name2 }}" src="{{ asset('images/' . $post->image_path) }}" class="hover:bg-gray-200 rounded-lg transition duration-500 ease-in-out transform hover:-translate-y-1
                        hover:scale-105" style="max-width:500px; max-height:500px;">
                    @else
                    <image id="{{ $name2 }}" class="hover:bg-gray-200 rounded-lg transition duration-500 ease-in-out transform hover:-translate-y-1
                        hover:scale-105" style="max-width:500px; max-height:500px;">
                    @endif
                    </div>
                    <div class="float-right flex items-center">
                        <div class=" inline-block mr-2">
                            <label class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150">
                                <span class="leading-normal" style="font-size:13px">Upload another image</span>
                                <input type="file" accept="image/*" class="hidden" onchange="Nice('{{ $name2 }}')" name="image" id="myInput" />
                        </div>
                        <div class=" inline-block mr-2">
                            <input type="reset" value="REMOVE IMAGE" class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150 leading-normal" style="font-size:13px" onclick="Reset('{{ $name2 }}')">
                        </div>
                        <div class="inline-block">
                            <link rel="stylesheet" href="css/button.css">
                            <button type="submit" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest">Change!</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div id="{{ $name }}" class="bg-gray-100 p-3 rounded-lg w-5/6 hover:bg-gray-200 ml-20 mb-2 transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-107">
            <p class=" text-2xl ">{{ $post->body }}</p>


            <div class="flex justify-center">
                <object data="{{ asset('images/' . $post->image_path) }}" class=" w-full rounded-lg mt-2 " >
                </object>
            </div>
        </div>

        @auth
        @if(Auth::user()->id == $post->user->id)
        <div class=" absolute top-0 right-0 m-2">
            <!-- Button -->
            <button @click="showModal = !showModal" class="px-4 py-2 text-sm bg-white rounded-xl border border-gray-200 text-gray-500 focus:outline-none focus:ring-0 font-bold focus:bg-indigo-50 focus:text-indigo transition duration-500 ease-in-out transform hover:-translate-y-1
                 hover:scale-125 hover:bg-gray-50" onclick="HidePost('{{ $name }}')"><i class="far fa-edit"></i></button>

        </div>
        @endif
        @endauth









        <div class="flex items-center justify-center mt-1 mr-16 bg-gray-100 backdrop-brightness-75 w-5/6 ml-20 py-2
        rounded-lg pr-16 hover:bg-gray-200 space-x-28 transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110">

            <span class="text-green-500 mr-2 ml-20 text-2xl ">{{ $post->likes->count() }}
                <!-- {{ Str::plural('like', $post->likes->count()) }} -->
            </span>

            @guest
            <i class="fas fa-heart text-green-500 mr-2 text-2xl mt-1"></i>
            @endguest
            @auth

            @if (!$post -> likedBy(auth()->user()))

            <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button type="submit" class="text-green-500 mr-2 hover:text-green-400 text-xl
                transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1">
                    <i class="fas fa-heart"> </i></button>
            </form>
            @else
            <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                @method('DELETE')
                <div class="lock">
                    <button type="submit" class="text-green-500 mr-2 text-xl ">
                        <i class="fas fa-heart text-green-500 icon-unlock mt-1"></i>
                        <i class="fas fa-heart-broken text-red-500 icon-lock mt-1"></i>
                </div>
                </button>
            </form>
            @endif

            <button onclick="TestsFunction('{{ $post->id }}')" class="mr-3">
                <i class="far fa-comment-dots text-2xl
                transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1">
                </i>
            </button>

            @endauth

            @can('delete', $post)
            <div>

                <form action="{{ route('posts.destroy', $post) }}" method="post">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    @method('DELETE')

                    <button type="submit" class="text-red-500 hover:text-red-400
                    mr-2 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                        <i class="fas fa-trash-alt text-xl mt-1"></i></button>
                </form>

            </div>

            @endcan


        </div>
        <div id="{{ $post->id }}" style="display:none" class=" w-5/6">
            @auth
            <form action="{{ route('comments.store', $post) }}" method="post" class="mb-4 flex w-full items-center" onsubmit="initBurst()">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="50" rows="3" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                                @error('body') border-red-500 @enderror ml-20 mt-10" style="display:inline-block" placeholder="Share your thoughts!"></textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}" />
                <div>
                    <button type="submit" class="button button--moema px-5 py-3 bg-gray-800
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest float-right ml-24">Reply!</button>

                </div>
            </form>

            @endauth
        </div>
        <div class="ml-10">
            @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
        </div>
    </div>

</div>