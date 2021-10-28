@foreach($comments as $comment)
<script src="{{ asset('js/hideClick.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link rel="stylesheet" href="css/button.css">
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">


<div @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <div class="inline-block h-1">
        <a href="{{ route('users.posts', $comment->user) }}">
            @if ($comment->user->avatar != NULL)
            <img src="{{ asset('images/' . $comment->user->avatar) }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 mr-2 rounded-full border-solid border-4 border-light-blue-500" style="width: 80px; height: 80px">
            @else
            <img src="{{ asset('images/boy.png') }}" class="transition duration-500 ease-in-out transform hover:-translate-y-1
                hover:scale-110 mt-1 hover:bg-gray-200 inline object-cover w-16 h-16 mr-2 rounded-full border-solid border-4 border-light-blue-500" style="width: 80px; height: 80px">
            @endif
            </a>
    </div>
    <div class="inline-block">
        <a href="{{ route('users.posts', $comment->user) }}" class="font-bold">{{ $comment->user->name }}</a>
        <span class="ml-1">@_</span><span>{{ $comment->user->username }}</span>
        <p class="text-gray=600 text-sm">
            {{ $comment->created_at->diffForHumans() }}
        </p>
    </div>

    <div class="ml-6">
        <p class="mb-2 ml-14 text-xl bg-gray-100 p-2 rounded-lg w-4/6 hover:bg-gray-200">{{ $comment->body }}</p>
    </div>
    @auth
    <div class=" ml-20 flex items-center mt-1">
        <button onclick="TestsFunction('{{ $comment->id }}')" class="mr-3 hover:underline">
            Reply
        </button>
        @can('delete', $comment)
        <div>

            <form action="{{ route('comments.destroy', $comment) }}" method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                @method('DELETE')

                <button onclick="TestsFunction('{{ $comment->id }}')" class="mr-3 hover:underline">
                    Delete
                </button>
            </form>

        </div>
        @endcan

    </div>
    @endauth
    <div id="{{ $comment->id }}" style="display:none" class="grid-cols-2">
        @auth
        <form method="post" action="{{ route('comments.store', $post) }}">
            @csrf
            <div class="" style="display: inline-block; vertical-align:middle">
                <textarea name="body" id="body" cols="50" rows="1" class="bg-gray-100 border-2 w-3/4 p-1 rounded-lg
                                @error('body') border-red-500 @enderror ml-20 mt-2 h-16" style="display:inline-block" placeholder="Share your thoughts!"></textarea>
                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div style="display: inline-block; vertical-align:middle">
                <input type="submit" class="rounded-lg bg-gray-800 hover:bg-gray-500 text-gray-200 p-2" value="Reply!" />
            </div>
        </form>
        @endauth
    </div>
    @include('posts.commentsDisplay', ['comments' => $comment->replies])
</div>
@endforeach
