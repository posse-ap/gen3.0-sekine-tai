<!-- resources/views/learning_records/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Learning Record</title>
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .loading-spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <h1>Create Learning Record</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('learning_records.store') }}" method="post" id="learningRecordForm">
        @csrf

        <label for="learning_date">Learning Date:</label>
        <input type="date" name="learning_date" required><br>

        <label for="learning_time">Learning Time (hours):</label>
        <input type="number" name="learning_time" step="0.01" required><br>

        <label for="contents">Select Contents:</label>
        @foreach ($contents as $content)
            <input type="checkbox" name="contents[]" value="{{ $content->id }}"> {{ $content->content_name }}<br>
        @endforeach

        <label for="languages">Select Languages:</label>
        @foreach ($languages as $language)
            <input type="checkbox" name="languages[]" value="{{ $language->id }}"> {{ $language->language_name }}<br>
        @endforeach

        <button type="submit" id="submitButton">Create Learning Record</button>
    </form>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        document.getElementById('learningRecordForm').addEventListener('submit', function () {
            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('submitButton').setAttribute('disabled', 'disabled');
        });
    </script>
</body>
</html>
