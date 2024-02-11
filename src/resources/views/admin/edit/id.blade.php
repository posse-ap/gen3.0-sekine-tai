<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>quizy</title>
    <link
        href="https://storage.googleapis.com/google-code-archive-downloads/v2/code.google.com/html5resetcss/html5reset-1.6.css">
</head>

<body>
    {{-- <p>{{$question}}</p> --}}
    <img src="/img/{{ $question->image }}" alt="">
    <form action="/{{ request()->path() }}" method="POST">
        @csrf
        <table>
            <tr>
                <th>選択肢</th>
                <th>正解</th>
            </tr>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach ($question->choices as $choice)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <input type="text" name="name{{ $loop->index }}" value="{{ $choice->name }}"" >
                    </td>
                    <td>
                        <input type="radio" name="valid" value="{{ $loop->index }}"
                        {{-- <input type="radio" name="valid" value="5" --}}
                            @if ($choice->valid) checked @endif>
                    </td>
                </tr>
            @endforeach
        </table>
        <input type="submit" value="更新">
    </form>
</body>

</html>
