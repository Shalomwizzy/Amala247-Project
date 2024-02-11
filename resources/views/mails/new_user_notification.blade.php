<!DOCTYPE html>
<html>
<head>
    <title>New User Registration</title>
    <!-- Add your custom CSS styles here -->
</head>
<body>
    <div class="admin-notification">
        <h1>Exciting news!</h1>
        <p>Hold onto your hats! We've got breaking news: A fantastic individual has just become the latest addition to your online family!</p>

        {{-- <p>First Name: {{ $user->first_name }}</p>
        <p>Last Name: {{ $user->first_name }}</p> --}}
        <p>Username: {{ $user->username }}</p>
        <p>Email: {{ $user->email }}</p>
    </div>
</body>
</html>
