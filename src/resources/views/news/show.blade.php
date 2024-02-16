<!-- resources/views/news/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news['title'] }}</title>
</head>
<body>
    <h1>{{ $news['title'] }}</h1>

    <img src="{{ $news['urlToImage'] }}" alt="News Image" style="max-width: 100%;">
    
    <p>{{ $news['content'] }}</p>

    <a href="{{ url('/news') }}">Back to News</a>
</body>
</html>
