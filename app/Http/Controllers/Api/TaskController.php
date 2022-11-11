<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Carbon;

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
        $existingTask = Task::find($task);

        if($existingTask->completed == true) {
            $existingTask->update([
                'completed' => false,
                'completed_at' => Carbon::now()
            ]);
        }elseif($existingTask->completed == false){
            $existingTask->update([
                'completed' => true,
                'completed_at' => Carbon::now()
            ]);
        }else{
            return 'Task does not exist';
        }

        return response()->json([
            'message' => 'Task updated successfully',
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
