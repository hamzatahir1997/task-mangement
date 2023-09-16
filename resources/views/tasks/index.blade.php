<div class="container mt-5">
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
    <!-- Include SortableJS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <!-- Task List with ID and data attributes for sorting -->
    <ul class="list-group" id="sortable-list">
        @foreach($tasks as $task)
            <li class="list-group-item" data-id="{{ $task->id }}">
                {{ $task->name }} (Priority: {{ $task->priority }})
                <div class="float-right">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('projects.index') }}" class="btn btn-success mb-2">Projects</a>

    <!-- SortableJS Script for Handling Drag & Drop -->
    <script>
        var sortable = new Sortable(document.getElementById('sortable-list'), {
            animation: 150,
            onUpdate: function(evt) {
                var items = evt.from.children;
                var updatedPriority = [];
                
                for(var i = 0; i < items.length; i++) {
                    var taskId = items[i].getAttribute('data-id');
                    updatedPriority.push(taskId);
                }

                fetch('/update-task-priority', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ priorities: updatedPriority })
                });
            }
        });
    </script>
</div>
