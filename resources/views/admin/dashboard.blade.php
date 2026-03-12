<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h4">Admin Dashboard</span>

        {!! logoutModal('admin.logout') !!}
    </nav>

    <div class="container mt-4">
         <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    Welcome, <strong>{{ auth('admin')->user()->name }}</strong>
                </h5>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $user->role === 'Admin' ? 'bg-danger' : 
                                               ($user->role === 'Manager' ? 'bg-warning text-dark' : 'bg-success') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
