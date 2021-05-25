<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ToDo - WebApp</title>

            
        <script src="{{ asset('js/fa.js') }}" defer></script>
        <script src="{{ asset('js/onclickUpload.js') }}" defer></script>
        <script src="{{ asset('js/datetime.js') }}" defer></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

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
                <div class="mb-0">
                    <label class="label-style" for="todo_title">Title:</label>
                    <div>
                        <input type="text" class="form-control mb-2 @error('todo_title') is-invalid @enderror" id="todo_title" name="todo_title" value="{{ $task->todo_title }}" placeholder="Type Title here..">
                        @error('todo_title')
                            <p role="alert" class="alert alert-dark">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <label class="label-style" for="todo_deadline">Deadline:</label>
                    <div class="mb-2">
                        <input class="date form-control mb-2" name="todo_deadline" type="text" placeholder="Select Date" value="{{ $task->todo_deadline }}">
                    </div>
                    <label class="label-style" for="todo_content">Content:</label>
                    <div>
                        <textarea class="form-control mb-2 @error('todo_content') is-invalid @enderror" id="todo_content" name="todo_content" placeholder="Type content here.." style="height: 240px">{{ $task->todo_content }}</textarea>
                        @error('todo_content')
                            <p role="alert" class="alert alert-dark">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <p class="attachment-style">Attachments: </p>
                        @if ($task->todo_attachment)
                            <img class="image-style" style="max-width: 300px;" src="{{ asset('/storage/img/'.$task->todo_attachment) }}" alt="{{ $task->todo_attachment }}"/>
                        @else
                            No attachments available
                        @endif
                    </div> 
                </div>
                <div class="shadow-sm p-3">
                    <div class="row">
                        <div class="col-sm-1 mt-2 mr-3">
                            <input class="hidden" name="img" id="upload" type="file"/>
                            <a href="" class="text-decor-null" id="upload_link">
                                <i class="far fa-images fa-2x icon-task-setting text-decor-null"></i>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <strong>{{ __('Save') }}</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>     
           
        <script type="text/javascript">
            $('.date').datepicker({format: 'yyyy-mm-dd'});  
        </script> 
    </body>
    @endsection
</html>