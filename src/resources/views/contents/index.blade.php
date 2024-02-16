<!-- resources/views/contents/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content List</title>
</head>
<body>
    <h1>Content List</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Content Name</th>
            <th>Color Code</th>
            <th>Actions</th>
        </tr>
        @foreach ($contents as $content)
            <tr @if($content->trashed()) style="color: red;" @endif>
                <td>{{ $content->id }}</td>
                <td>{{ $content->content_name }}</td>
                <td>{{ $content->color_code }}</td>
                <td>
                    @if($content->trashed())
                        <form action="{{ route('contents.restore', $content->id) }}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                    @else
                        <a href="{{ route('contents.edit', $content->id) }}">Edit</a>
                        <form action="{{ route('contents.delete', $content->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this content?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
