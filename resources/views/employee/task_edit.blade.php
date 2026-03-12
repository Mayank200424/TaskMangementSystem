<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Task Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Update Task Status</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('employee.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter task title" value="{{ $task->title }}" disabled>
                                @error('title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Task description" disabled>{{ value($task->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $task->due_date }}" disabled>
                                @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                </select>
                                @error('status')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary">
                                    Edit Status
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>