<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h5 text-dark">
            Manager Dashboard
        </span>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Add Task</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('manager.create-task') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter task title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Task description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="date" class="form-control">
                                @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="assigned">Assigned</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Assign Employee</label>
                                <select name="employee" class="form-select">
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary">
                                    Save Task
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
