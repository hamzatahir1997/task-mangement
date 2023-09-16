<div class="container mt-5">
    <h2>Edit Task</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $task->name }}" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <input type="number" class="form-control" name="priority" id="priority" value="{{ $task->priority }}" required>
        </div>

        <div class="form-group">
            <label for="project">Project</label>
            <select name="project_id" id="project" class="form-control">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
