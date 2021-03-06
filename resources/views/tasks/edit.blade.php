<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PINNED</title>

            
        <script src="{{ asset('js/fa.js') }}" defer></script>
        <script src="{{ asset('js/onclickUpload.js') }}" defer></script>
        <script src="{{ asset('js/datetime.js') }}" defer></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
    <body>
        <nav class="navbar sticky-top navbar-light p-3 mb-3 set-bg-white" style="box-shadow: 0px 1px 10px #999;">
            <div class="container-fluid">
                <a href="/tasks" class="navbar-brand"><strong style="letter-spacing: 5px; text-transform: uppercase;">Pinned</strong></a>
                <div class="d-flex">
                        <a href="{{ route('logout') }}" class="logout-style"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <form method="POST" enctype="multipart/form-data" action="/tasks/{{ $task->id }}/!important">
                @method('PUT')
                @csrf
                <div class="mb-0">
                    <div class="row justify-content-center items-start">
                        <div class="col-6">
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
                            <label class="label-style" for="todo_assign">Assign:</label>
                                <div class="mb-2">
                                    <select class="form-select mb-3" name="userID" id="userID" aria-label="Default select example">
                                        <option selected  value="{{ $task->assignedTo }}">{{ $task->assignedTo }}</option>
                                        @foreach($allUsers as $allUser)
                                        <option value="{{$allUser->id}}">{{$allUser->name}}</option>
                                        @endforeach
                                    </select>
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
                        </div>
                        <div class="col-6">
                            <div>
                                <p class="attachment-style">Attachments: </p>
                                @if ($task->todo_attachment)
                                    <img class="image-style" style="max-width: 650px; max-height: 350px;" src="{{ asset('/storage/img/'.$task->todo_attachment) }}" alt="{{ $task->todo_attachment }}"/>
                                @else
                                    No attachments available
                                @endif
                            </div> 
                            <br>
                            <input class="hidden" name="img" id="upload" type="file"/>
                                <a href="" class="text-decor-null" id="upload_link">
                                    <i class="far fa-images fa-2x icon-task-setting text-decor-null"></i>
                                </a>
                        </div>
                        <div class="col d-flex justify-content-start">
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
</html>