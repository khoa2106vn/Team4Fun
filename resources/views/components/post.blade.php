@props([
'post' => $post,

])


<div class="mb-8 transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-105 ml-3">
    <script src="{{ asset('js/hideClick.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <div class="inline-block h-1">
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
        <div class="bg-gray-100 p-3 rounded-lg w-5/6 hover:bg-gray-200 ml-20 mb-2 transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-107" >
            <p class=" text-2xl ">{{ $post->body }}</p>
            <div class="flex justify-center">
                <object data="{{ asset('images/' . $post->image_path) }}" class="w-full rounded-lg mt-2 ">
                </object>
            </div>
        </div>
        <div class="flex items-center justify-center mt-1 mr-16 bg-gray-100 backdrop-brightness-75 w-5/6 ml-20 py-2
        rounded-lg pr-16 hover:bg-gray-200 space-x-40 transition duration-500 ease-in-out transform hover:-translate-y-1
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
                    <link rel="stylesheet" href="css/button.css">
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
