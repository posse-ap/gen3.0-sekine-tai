<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call API</title>
</head>
<body>
    <h1>API Response:</h1>
    <pre id="api-response"></pre>

    <script>
        // APIのURL
        const apiUrl = 'https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default';

        // fetch関数を使用してAPIを呼び出す
        fetch(apiUrl)
            .then(response => {
                // レスポンスがJSON形式であれば解析して返す
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // ブラウザ上にAPIのレスポンスを表示
                document.getElementById('api-response').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                // エラーが発生した場合はコンソールにエラーメッセージを表示
                console.error('There was a problem with the fetch operation:', error.message);
            });
    </script>
</body>
</html>
