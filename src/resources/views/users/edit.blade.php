<!-- resources/views/users/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <label>Admin Flag:</label><br>
        <label><input type="radio" name="admin_flag" value="1" {{ $user->admin_flag == 1 ? 'checked' : '' }}> Admin</label>
        <label><input type="radio" name="admin_flag" value="0" {{ $user->admin_flag == 0 ? 'checked' : '' }}> Regular User</label><br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
