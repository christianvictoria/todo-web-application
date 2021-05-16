<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {   
        $user = User::find(Auth::id());
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // For Now not Working needed to have the ID of the current Logged In user
        $request->validate([
            'todo_title' => 'required|max:255',
            'todo_content' => 'required',
        ]);

        // $task = new Task();
        // $task->fill($request->all());

        Task::create([
            'todo_title' => request('todo_title'),
            'todo_content' => request('todo_content'),
        ]);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Task $task)
    {
        request()->validate([
            'todo_title' => 'required',
            'todo_content' => 'required',
        ]);

        $task->update([
            'todo_title' => request('todo_title'),
            'todo_content' => request('todo_content'),
        ]);

        return redirect('/tasks');
    }

}
