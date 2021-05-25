<?php

namespace App\Http\Controllers;

use App\Models\ShareTasks;
use Illuminate\Http\Request;

class ShareTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('sharetasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'todo_title' => 'required',
            'todo_content' => 'required'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShareTasks  $shareTasks
     * @return \Illuminate\Http\Response
     */
    public function show(ShareTasks $shareTasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShareTasks  $shareTasks
     * @return \Illuminate\Http\Response
     */
    public function edit(ShareTasks $shareTasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShareTasks  $shareTasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShareTasks $shareTasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShareTasks  $shareTasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShareTasks $shareTasks)
    {
        //
    }
}
