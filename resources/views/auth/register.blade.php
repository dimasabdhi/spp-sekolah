<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation"><br>

        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="student">Student</option>
            <option value="parent">Parent</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Register</button>
    </form>
</body>

</html>
