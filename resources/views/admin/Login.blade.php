<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.login-process') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="employee">Employee</option>
                                    <option value="manager">Manager</option>
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn bg-primary text-white">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
