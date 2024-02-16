<!-- resources/views/news/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <style>
        .news-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            max-width: 300px;
        }

        .news-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>News</h1>

    <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
        @foreach ($news as $index => $article)
            <div class="news-card">
                <img src="{{ $article['urlToImage'] }}" alt="News Image">
                <h2>{{ $article['title'] }}</h2>
                <p>{{ $article['description'] }}</p>
                <a href="{{ route('news.show', ['id' => $index]) }}">Read more</a>
            </div>
        @endforeach
    </div>
</body>
</html>
