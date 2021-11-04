@props([
'post' => $post,

])
<!-- Modal Background -->
<div x-show="showModal" class=" text-gray-500 flex items-center justify-center overflow-auto z-50 bg-black bg-opacity-40 left-0 right-0 top-0 bottom-0 rounded-lg" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal" style="width:150%" class="m-6 bg-white rounded-xl shadow-2xl p-6 mx-10" @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                <!-- Title -->
                <span class="font-bold block text-2xl mb-3"><i class="far fa-edit"></i> Edit Post </span>

                <form action="{{ route('post.edit', $post->id) }}" method="post" enctype="multipart/form-data" class="mb-4" onsubmit="initBurst()">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{ method_field('PATCH') }}
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg 
						@error('body') border-red-500 @enderror" placeholder="Change your post!"></textarea>

                        @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center mb-5 rounded-lg hover:bg-gray-50">
                        <img id="outputEdit" class="hover:bg-gray-200 rounded-lg transition duration-500 ease-in-out transform hover:-translate-y-1
                 hover:scale-150" style="max-width:250px; max-height:100px;" />
                    </div>
                    <div class="float-right flex items-center">
                        <div class=" inline-block mr-2">
                            <label class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150">
                                <span class="leading-normal" style="font-size:13px">Upload another image!</span>
                                <input type="file" accept="image/*" class="hidden" onchange="loadFileEdit(event)" name="image" id="myInput" />
                        </div>
                        <div class=" inline-block mr-2">
                            <input type="reset" value="Reset" class=" w-full flex flex-col items-center px-2 py-3 bg-white rounded-md 
					shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 
					hover:text-white text-purple-600 ease-linear transition-all duration-150 leading-normal" style="font-size:13px" onclick="clearFileEdit(event)">
                        </div>
                        <div class="inline-block">
                            <link rel="stylesheet" href="css/button.css">
                            <button type="submit" class="button button--moema px-5 py-3 bg-gray-800 
						hover:bg-gray-700 hover:text-white text-gray-300 relative block focus:outline-none border-2 
						border-solid rounded-lg text-sm text-center font-semibold uppercase tracking-widest">Edit!</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>