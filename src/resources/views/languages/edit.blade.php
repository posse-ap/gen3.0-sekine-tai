<!-- resources/views/languages/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Language</title>
</head>
<body>
    <h1>Edit Language</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('languages.update', $language->id) }}" method="post">
        @csrf
        @method('PUT')
        
        <label for="language_name">Language Name:</label>
        <input type="text" name="language_name" value="{{ $language->language_name }}" required><br>

        <label for="color_code">Color Code:</label>
        <input type="text" name="color_code" value="{{ $language->color_code }}" required><br>

        <button type="submit">Update Language</button>
    </form>
</body>
</html>
