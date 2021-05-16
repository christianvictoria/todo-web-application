<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ToDo - WebApp</title>

            
        <script src="{{ asset('js/fa.js') }}" defer></script>
        <script src="{{ asset('js/onclickUpload.js') }}" defer></script>
        <script src="{{ asset('js/datetime.js') }}" defer></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">  
        <link type="text/css" rel="stylesheet" href="{{ asset('css/home.css') }}">
        
    </head>
@extends('layouts.app')


@section('content')
    <body>
        <div class="container">
            <form method="POST" enctype="multipart/form-data" action="/tasks/{{ $task->id }}/!important">
            @method('PUT')
                @csrf
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control mb-2" id="todo_title" name="todo_title" value="{{ $task->todo_title }}" placeholder="Type Title here..">
                    </div>
                        <textarea class="form-control" id="todo_content" name="todo_content" placeholder="Type content here.." style="height: 440px">{{ $task->todo_content }}</textarea>
                        <select class="form-select" id="fld_isImportant" name="fld_isImportant" aria-label="Set as Pinned">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                          </select>
                </div>
                <div class="shadow-sm p-3">
                    <div class="row">
                        <div class="col-sm-1 mt-2 mr-3">
                            <input class="hidden" id="upload" type="file"/>
                            <a href="" class="text-decor-null" id="upload_link"><i class="far fa-images fa-2x icon-task-setting text-decor-null"></i></a>
                        </div>
                        <div class="col-sm-1">
                        <input class="hidden" id="date" type="date"/>
                           <a href="" id = "date_link"> <i class="far fa-calendar-alt mt-2 fa-2x icon-task-setting"></i> </a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary"><strong>{{ __('Submit') }}</strong></button>
                        </div>
                      </div>
                </div>
            </form>
        </div>
    </body>
    @endsection
</html>