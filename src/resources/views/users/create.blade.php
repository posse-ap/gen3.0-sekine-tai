<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label>Admin Flag:</label><br>
        <label><input type="radio" name="admin_flag" value="1" required> Admin</label>
        <label><input type="radio" name="admin_flag" value="0" required> Regular User</label><br>

        <button type="submit">Create User</button>
    </form>
</body>
</html>
