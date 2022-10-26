<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // views all tasks
    public function index()
    {
        return Task::all();
    }

    // stores new tasks
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100']
        ]);

        Task::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Task created successfully'
        ]);
    }

    // shows specific ask requested by user
    public function show($task)
    {
        return Task::find($task);
    }

    // updates a specific task
    public function update(Request $request, $task)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100']
        ]);

        Task::find($task)->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Task updated successfully'
        ]);
    }

    // destroys specific task
    public function destroy($task)
    {
        Task::find($task)->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
