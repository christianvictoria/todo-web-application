<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index(Request $request)
    {   
        $today = date("Y-m-d");
        $user = User::find(Auth::id());
        $searchInput = $request->input('searchInput');

        $upcomingTasks = $user->tasks()->where([['fld_isImportant','=','0'], ['todo_deadline','>',"$today"]])->get();
        $tasks = $user->tasks()->search($searchInput)->get();
        $pinnedTasks = $user->tasks()->where('fld_isImportant','=','1')->get();
        $missedTasks = $user->tasks()->where([['fld_isImportant','=','0'], ['todo_deadline','<',"$today"]])->get();
        return view('tasks.index', compact('tasks', 'pinnedTasks', 'missedTasks','upcomingTasks'));
    }

    public function create()
    {
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        // For Now not Working needed to have the ID of the current Logged In user
        $request->validate([
            'todo_title' => 'required',
            'todo_content' => 'required',
        ]);
        
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->todo_title = $request->todo_title;
        $task->todo_content = $request->todo_content;
        $task->todo_deadline = $request->todo_deadline;
        if($request->hasFile('img')){
            $file = $request->file('img')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file('img')->getClientOriginalExtension();
            $file_to_store = $filename.'_'.time().'.'.$extension;
            $request->file('img')->storeAs('public/img', $file_to_store);
            $task->todo_attachment = $file_to_store;
        }
        $task->save();
        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
 
    }

    public function update(Task $task, $pinned, Request $request)
    {   
        $arr = array("important", "notimportant");
        if (in_array($pinned, $arr)) {
            if($pinned == $arr[0]) $task->update(['fld_isImportant' => 1]);
            if($pinned == $arr[1]) $task->update(['fld_isImportant' => 0]);
            return redirect('/tasks');
        }
        request()->validate([
            'todo_title' => 'required',
            'todo_content' => 'required',
        ]);
        if($request->hasFile('img')){
            $file = $request->file('img')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file('img')->getClientOriginalExtension();
            $file_to_store = $filename.'_'.time().'.'.$extension;
            $request->file('img')->storeAs('public/img', $file_to_store);
            $task->update([
                'todo_title' => $request->todo_title,
                'todo_content' => $request->todo_content,
                'todo_deadline' => $request->todo_deadline,
                'todo_attachment' => $file_to_store
            ]);
        } else {
            $task->update([
                'todo_title' => $request->todo_title,
                'todo_content' => $request->todo_content,
                'todo_deadline' => $request->todo_deadline
            ]);
        }
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
