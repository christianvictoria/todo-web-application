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
        $tasks = $user->tasks()->where('todo_title','!=','')->get();
        $pinnedTasks = $user->tasks()->where('fld_isImportant','=','1')->get();

        return view('tasks.index', compact('tasks', 'pinnedTasks'));
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

        $task = new Task();
        $task->fill($request->all());
        $task->user_id = auth()->user()->id;

        $task->save();

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
 
    }

    public function update(Task $task, $pinned)
    {   
        
        if ($pinned && $pinned == "important"){

            $setAsPinned = 1;
            $task->update([
                'fld_isImportant' => $setAsPinned,
            ]);
            return redirect('/tasks');
        
        }

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

    public function destroy($id)
    {

        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks');
    }
    public function deleteBlank()
    {
        $task = Task::where('title','=','')->delete();

        return redirect('/tasks');
    }

}
