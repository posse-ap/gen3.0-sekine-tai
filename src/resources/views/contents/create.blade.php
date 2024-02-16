<!-- resources/views/contents/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Content</title>
</head>
<body>
    <h1>Create Content</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contents.store') }}" method="post">
        @csrf
        <label for="content_name">Content Name:</label>
        <input type="text" name="content_name" required><br>

        <label for="color_code">Color Code:</label>
        <input type="text" name="color_code" required><br>

        <button type="submit">Create Content</button>
    </form>
</body>
</html>
