@extends('layout.app')
@section('title', '$post->title')
@section('content')

    @include('partials.header')
    <div id="single_post" data-post-id="{{ $post->id }}">
        <div class="m-auto px-4 py-8 max-w-xl">
            <div class="bg-white shadow-2xl">
                <div>
                    <img src="/storage/posts/{{ $post->thumbnail }}">
                </div>
                <div class="px-4 py-2 mt-2 bg-white">
                    <h2 class="font-bold text-2xl text-gray-800">{{ $post->title }}</h2>
                    <p class="sm:text-sm text-xs text-gray-700 px-2 mr-1 my-3">
                        {!! $post->description !!}
                    </p>
                </div>
            </div>


            <div>
                <section class="rounded-b-lg mt-4">
                    <textarea name="content" id="content"
                              class="w-full shadow-inner p-4 border-0 mb-4 rounded-lg focus:shadow-outline text-2xl @error('text') border-red-500 @enderror"
                              placeholder="Ваш комментарий..." spellcheck="false"></textarea>

                    @error('text')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    @auth()
                    <button type="submit" id="send"
                            class="font-bold py-2 px-4 w-full bg-purple-400 text-lg text-white shadow-md rounded-lg ">
                        Написать
                    </button>
                    @endauth
                    <div id="task-comments" class="pt-4">
                        @foreach($post->comments as $comment)
                            <div
                                class="bg-white rounded-lg p-3  flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                                <div class="flex flex-row justify-center mr-2">
                                    <h3 class="text-purple-600 font-semibold text-lg text-center md:text-left ">{{ $comment->user->name }}</h3>
                                </div>


                                <p style="width: 90%"
                                   class="text-gray-600 text-lg text-center md:text-left ">{{ $comment->text }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#send').click(function () {
            let content = $('#content').val();
            let post_id = $('#single_post').data('post-id')
            console.log(content)
            $.ajax({
                method: 'post',
                url: '/comments/store',
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    text: content,
                    post_id: post_id,
                }),
                success: function () {
                    console.log('Ответ получен')
                }
            })
        })

    </script>

@endsection
