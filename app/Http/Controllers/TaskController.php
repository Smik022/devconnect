<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks for the employer
    public function index()
    {
        $tasks = Task::with('user')->get();  // Get all tasks with user info
        $developers = User::where('role', 'Developer')->get();
        return view('tasks.index', compact('tasks', 'developers'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'assigned_to' => 'required|exists:users,id',  
            'deadline' => 'required|date',
            'description' => 'required',
        ]);

        // Create the task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
        ]);

        // Redirect to the task list after creating
        return redirect()->route('tasks.index');
    }

    // Update the task status
    public function updateStatus(Task $task, Request $request)
    {
        if ($task->assigned_to != auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($request->status == 'Done' && $task->status != 'Done') {
            $task->status = 'In Progress'; 
            $task->approved_by_employer = false;  
        } else {
            $task->status = $request->status;
        }

        $task->save();

        return response()->json(['message' => 'Task status updated successfully']);
    }

    public function approveTask(Task $task)
    {
        if (auth()->user()->role != 'Employer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Approve the task and move it to the "Done" column
        $task->approved_by_employer = true;
        $task->status = 'Done';
        $task->save();

        return response()->json(['message' => 'Task approved and moved to Done']);
    }

    public function deleteTask(Task $task)
    {
        if (auth()->user()->role != 'Employer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }


}
