<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store a new project in the database
    public function store(Request $request)
    {
        Project::create($request->all());
        return redirect()->route('projects.index');
    }

    // Show the form for editing a project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Update a project in the database
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route('projects.index');
    }

    // Remove a project from the database
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
