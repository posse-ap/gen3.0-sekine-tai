<!-- resources/views/contents/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Content</title>
</head>
<body>
    <h1>Edit Content</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contents.update', $content->id) }}" method="post">
        @csrf
        @method('PUT')
        
        <label for="content_name">Content Name:</label>
        <input type="text" name="content_name" value="{{ $content->content_name }}" required><br>

        <label for="color_code">Color Code:</label>
        <input type="text" name="color_code" value="{{ $content->color_code }}" required><br>

        <button type="submit">Update Content</button>
    </form>
</body>
</html>
