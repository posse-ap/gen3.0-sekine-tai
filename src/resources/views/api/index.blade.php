<!-- resources/views/api/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Response</title>
</head>
<body>
    <h1>API Response</h1>

    <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
</body>
</html>