<!-- resources/views/languages/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Language</title>
</head>
<body>
    <h1>Create Language</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('languages.store') }}" method="post">
        @csrf
        <label for="language_name">Language Name:</label>
        <input type="text" name="language_name" required><br>

        <label for="color_code">Color Code:</label>
        <input type="text" name="color_code" required><br>

        <button type="submit">Create Language</button>
    </form>
</body>
</html>
