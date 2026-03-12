@php
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h5">Manager Dashboard</span>
        {!! logoutModal('manager.logout') !!}
    </nav>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    Welcome, <strong>{{ auth('manager')->user()->name }}</strong>
                </h5>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                {!! message() !!}
            </div>
            <div>
                <a href="{{ route('manager.create-task.form') }}" class="btn btn-primary">
                    Add Task
                </a>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Employee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $task->due_date }}
                                    </span>
                                </td>
                                <td>
                                    {{ $task->user->name }}
                                </td>
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
                                <td>
                                    <a href="{{ route('task.edit',$task->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No tasks available
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>