<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">View All Tasks</a>
        <h2 class="mb-0">Task Management</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-success">+ New Task</a>
    </div>

    <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search tasks..." value="{{ request()->search }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>

    @if($tasks->isEmpty())
        <div class="alert alert-warning">No tasks found.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($tasks as $task)
                <div class="col">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->name }}</h5>

                            <!-- Display assigned user -->
                            <h6 class="card-subtitle mb-2 text-muted">Assigned to: {{ $task->user->name }}</h6>

                            <p class="card-text text-muted">{{ $task->description }}</p>

                            <!-- Status badge inserted here -->
                            <div class="mb-3">
                                <span class="badge bg-{{ $task->status === 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        Do you want to delete the task: <strong>{{ $task->name }}</strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</body>
</html>
