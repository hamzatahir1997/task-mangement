<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks ordered by priority.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Eager load the related project data and order tasks by priority
        $tasks = Task::with('project')->orderBy('priority', 'asc')->get();
        
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Fetch all projects to display in the dropdown
        $projects = Project::all();
        
        return view('tasks.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created task in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'required|integer|exists:projects,id'
        ]);

        $task = new Task;
        $task->name = $request->name;
        $task->priority = $request->priority;
        // Set the associated project ID for the task
        $task->project_id = $request->project_id;

        $task->save();

        // Redirect back to tasks index with success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        // Fetch all projects for the dropdown in the edit form
        $projects = Project::all();
        
        return view('tasks.edit', ['task' => $task, 'projects' => $projects]);
    }

    /**
     * Update the specified task in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'required|integer|exists:projects,id'
        ]);

        $task->name = $request->name;
        $task->priority = $request->priority;
        // Update the associated project ID for the task
        $task->project_id = $request->project_id;

        $task->save();

        // Redirect back to tasks index with success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from the database.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();
        // Redirect back to tasks index with success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    /**
     * Update task priorities based on the reordered list from the front end.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePriority(Request $request)
    {
        $priorities = $request->input('priorities');
        
        foreach ($priorities as $index => $taskId) {
            $task = Task::find($taskId);
            // Update the priority based on new position
            $task->priority = $index + 1;
            $task->save();
        }

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
