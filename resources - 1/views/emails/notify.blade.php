@component('mail::message')
# Your child has posted something new!

{{ $user->name }} has posted something new, check it out!

@component('mail::button', ['url' => route('posts.show', $post)])
Click here!
@endcomponent

Thanks, 4Kids<br>

@endcomponent
