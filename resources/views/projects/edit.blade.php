<div class="container mt-5">
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" name="name" value="{{ $project->name }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Update Project</button>
    </form>
</div>
