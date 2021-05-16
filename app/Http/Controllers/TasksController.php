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
        // print_r($tasks);

        // $tasks = $user->tasks()->where('title','!=','')->get();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // For Now not Working needed to have the ID of the current Logged In user
        $request->validate([
            'todo_title' => 'required|max:255',
            'todo_content' => 'required',
        ]);

        $task = new Task();
        $task->fill($request->all());
        $task->account_id = auth()->user()->id;

        // print_r($task);

        // Task::create([
        //     'todo_title' => request('todo_title'),
        //     'todo_content' => request('todo_content'),
        // ]);

        $task->save();

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
        // return view('tasks.edit', compact('task'));
 
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
