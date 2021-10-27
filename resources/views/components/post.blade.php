@props([
'post' => $post,

])


<div class="mb-8">
    <script src="{{ asset('js/hideClick.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <div class="inline-block h-1">
        <a href="{{ route('users.posts', $post->user) }}">
            <img src="{{ asset('images/boy.png') }}" class="roundImg transition duration-500 ease-in-out transform hover:-translate-y-1 
                hover:scale-110 mt-1 hover:bg-gray-200" style="width: 100px; height: auto">
        </a>
    </div>
    <div class="inline-block">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
        <span class="ml-1">@_</span><span>{{ $post->user->username }}</span>
        <p class="text-gray=600 text-sm">
            {{ $post->created_at->diffForHumans() }}
        </p>
    </div>

    <div class="ml-6">
        <p class="mb-2 ml-20 text-xl bg-gray-100 p-2 rounded-lg w-4/6 hover:bg-gray-200">{{ $post->body }}</p>

        <div class="flex items-center mt-1">

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
        <div id="{{ $post->id }}" style="display:none" class="flex items-center">
            @auth
            <form action="{{ route('comments.store', $post) }}" method="post" class="mb-4" onsubmit="initBurst()">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="50" rows="1" class="bg-gray-100 border-2 w-2/3 p-4 rounded-lg 
                                @error('body') border-red-500 @enderror ml-20 mt-10" style="display:inline-block" placeholder="Share your thoughts!"></textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
        
                </div>
                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}"/>
                <div>
                    <link rel="stylesheet" href="css/button.css">
                    <button type="submit" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest float-right">Reply!</button>

                </div>
            </form>

            @endauth
        </div>
        <div class="ml-10">
            @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
        </div>
    </div>

</div>