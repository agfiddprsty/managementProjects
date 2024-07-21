<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $project->tasks()->create($request->all());
        return redirect()->route('projects.show', $project);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task->update($request->all());
        return redirect()->back();
    }
}
