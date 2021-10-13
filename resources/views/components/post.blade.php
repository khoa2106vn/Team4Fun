@props(['post' => $post])

<div class="mb-4">
    <i class="far fa-user "></i>
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray=600 text-sm">
        {{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>

    <div class="flex items-center">

        <span class="text-green-500 mr-2">{{ $post->likes->count() }}
            {{ Str::plural('like', $post->likes->count()) }}</span>


        @auth

        @if (!$post -> likedBy(auth()->user()))

        <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <button type="submit" class="text-blue-500 mr-2">Like</button>
        </form>
        @else
        <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            @method('DELETE')

            <button type="submit" class="text-blue-500 mr-2">Unlike</button>
        </form>
        @endif

        @endauth

        @can('delete', $post)
        <div>

            <form action="{{ route('posts.destroy', $post) }}" method="post">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                @method('DELETE')

                <button type="submit" class="text-red-500 mr-2">Delete</button>
            </form>

        </div>
        @endcan

    </div>

</div>