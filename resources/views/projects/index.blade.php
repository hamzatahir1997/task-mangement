<div class="container mt-5">
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>
    <ul class="list-group">
        @foreach($projects as $project)
            <li class="list-group-item">
                {{ $project->name }}
                <div class="float-right">
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary mb-3">Tasks</a>
</div>
