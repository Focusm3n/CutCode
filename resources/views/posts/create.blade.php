@extends('layout.app')

@section('title', 'Форма добавления')

@section('content')
    <div class="m-auto px-4 py-8 max-w-xl">
        <div class="row max-w-6xl">
            <div class="mb-3">
                <label for="formFile" class="form-label">Пример ввода файла по умолчанию</label>
                <input class="form-control" type="file" id="preview">
            </div>
            <div class="col">
                <input type="text" id="title" class="form-control" placeholder="Заголовок" aria-label="Заголовок">
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Содержание" id="description"></textarea>
            </div>
        </div>
        <input type="submit" id="send"
               class="font-bold py-2 px-4 w-full bg-purple-400 text-lg text-white shadow-md rounded-lg "
               value="Добавить">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#send').click(function () {
            let title = $('#title').val();
            console.log(title)
            let description = $('#description').val();
            let preview = $('#preview').val();
            $.ajax({
                method: 'post',
                url: '/posts/store',
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    title: title,
                    description: description,
                    preview: preview,
                }),
                success: function () {
                    console.log('Ответ получен')
                }
            })
        })

    </script>
@endsection
