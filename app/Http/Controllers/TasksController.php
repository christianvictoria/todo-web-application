<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TasksController extends Controller
{
    public function index(Request $request)
    {   
        $date_today = date("Y-m-d");
        $user = User::find(Auth::id());
        $searchInput = $request->input('searchInput');
        $tasks = $user->tasks()->search($searchInput)->get();
        $pinnedTasks = $user->tasks()->where('fld_isImportant','=','1')->get();
        //increment 2 days
        $mod_date = strtotime($date_today."+ 3 days");
        $date_tree_days_ahead = date("Y-m-d",$mod_date);
        $upcomingTasks = $user->tasks()->where([['todo_deadline','>',"$date_today"], ['todo_deadline', '<=', "$date_tree_days_ahead"]])->get();
        $ongoingTasks = $user->tasks()->where([['todo_deadline','=',"$date_today"]])->get();
        $missedTasks = $user->tasks()->where([['todo_deadline','<',"$date_today"]])->get();

        // for assign 
        $assignedTasks = DB::table('tasks')->where([['assignedTo','=', $user->id]])->get(); 


        return view('tasks.index', compact('tasks', 'pinnedTasks', 'upcomingTasks', 'ongoingTasks', 'missedTasks', 'user', 'assignedTasks'));
    }

    public function create() { return view('tasks.index', ['tasks' => $tasks]); }

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

    public function edit(Task $task) { 
        $allUsers = DB::table('users')->get();
        return view('tasks.edit', ['task' => $task, 'allUsers'=> $allUsers]); }

    public function share(Task $task) { 
        $user = User::find(Auth::id());
 
        return view('tasks.share', ['task' => $task, 'user' => $user]); }

    public function assign(Task $task){
        $user = User::find(Auth::id());
        return view('tasks.assign', ['task' => $task, 'user' => $user]);  }

    public function update(Task $task, $pinned, Request $request)
    {   
        $arr = array("important", "notimportant", "assigned");
        if (in_array($pinned, $arr)) {
            if($pinned == $arr[0]) $task->update(['fld_isImportant' => 1]);
            if($pinned == $arr[1]) $task->update(['fld_isImportant' => 0]);
            return redirect('/tasks');
        }
        request()->validate([
            'todo_title' => 'required',
            'todo_content' => 'required',
        ]);
        $task->update([
            'todo_title' => $request->todo_title,
            'todo_content' => $request->todo_content,
            'todo_deadline' => $request->todo_deadline,
            'assignedTo' => $request->userID
        ]);
        if($request->hasFile('img')){
            $file = $request->file('img')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file('img')->getClientOriginalExtension();
            $file_to_store = $filename.'_'.time().'.'.$extension;
            $request->file('img')->storeAs('public/img', $file_to_store);
            $task->update([ 'todo_attachment' => $file_to_store ]);
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
