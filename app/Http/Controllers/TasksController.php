<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store()
    {
        // For Now not Working needed to have the ID of the current Logged In user
        request()->validate([
            'todo_title' => 'required',
            'todo_content' => 'required',
        ]);

        Task::create([
            'account_id' => $task->account_id = auth()->user()->id,
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
