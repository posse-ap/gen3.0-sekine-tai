<!-- resources/views/languages/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language List</title>
</head>
<body>
    <h1>Language List</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Language Name</th>
            <th>Color Code</th>
            <th>Actions</th>
        </tr>
        @foreach ($languages as $language)
            <tr @if($language->trashed()) style="color: red;" @endif>
                <td>{{ $language->id }}</td>
                <td>{{ $language->language_name }}</td>
                <td>{{ $language->color_code }}</td>
                <td>
                    @if($language->trashed())
                        <form action="{{ route('languages.restore', $language->id) }}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit">Restore</button>
                        </form>
                    @else
                        <a href="{{ route('languages.edit', $language->id) }}">Edit</a>
                        <form action="{{ route('languages.delete', $language->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this language?')">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
