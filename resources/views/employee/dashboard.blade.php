<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h5">Employee Dashboard</span>

        {!! logoutModal('employee.logout') !!}
    </nav>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    Welcome, <strong>{{ auth('employee')->user()->name }}</strong>
                </h5>
                <p class="text-muted mb-0">
                    Here are your assigned tasks
                </p>
            </div>
        </div>

        <div class="row">
            {!! message() !!}
            @forelse ($tasks as $task)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            {{ $task->title }}
                        </h5>

                        <p class="card-text">
                            {{ $task->description }}
                        </p>
                    </div>

                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            Due Date: {{ $task->due_date }}
                        </small>
                        <br>
                        <small class="text-muted">
                            Status:
                            <td>
                                @if ($task->status === 'pending')
                                <span class="badge bg-warning">Pending</span>
                                @elseif ($task->status === 'assigned')
                                <span class="badge bg-info">Assigned</span>
                                @elseif ($task->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                                @elseif ($task->status === 'in_progress')
                                <span class="badge bg-info">InProgress</span>
                                @endif
                            </td>
                        </small>
                    </div>

                    <div class="card-footer bg-white border-0 d-flex justify-content-end">
                        <a href="{{ route('employee.edit',$task->id) }}"
                            class="btn btn-sm btn-primary">
                            Edit Task Status
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No tasks assigned yet.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>