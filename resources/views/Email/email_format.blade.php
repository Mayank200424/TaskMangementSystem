<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Hello {{ $users->name }},</h2>

    <p>Your account has been successfully created.</p>

    <p><strong>Email:</strong> {{ $users->email }}</p>
    <p><strong>Role:</strong> {{ $users->role }}</p>

    <p>You can now login and start using the system.</p>

    <p>Regards,<br>Team</p>
</body>
</html>
