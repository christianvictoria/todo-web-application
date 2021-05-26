<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>ToDo - WebApp</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{ asset('js/fa.js') }}" defer></script>
        <script src="{{ asset('js/onclickUpload.js') }}" defer></script>
        <script src="{{ asset('js/datetime.js') }}" defer></script>
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
                <a class="navbar-brand"><strong>TODO-WEB-APPLICATION</strong></a>
                <div class="d-flex">
                    <a href="/sharetasks">
                        <button type="button" class="btn btn-primary">Share Task</button>
                    </a>
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
            <div class="row justify-content-center align-items-start">
                <div class="col">
                    <form action="/tasks" method="GET">
                    {{csrf_field()}}
                        <div class="input-group">
                            <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Search task here..">
                            <button type ="submit" class="input-group-text">
                                <i class="fas fa-search icons-setting"></i>
                            </button>
                        </div>
                    </form>
                
                    <div class="set-height-tasks border" >
                        <div class="p-3 sticky-top border set-bg-white">
                            <h3 class="text-center header-size"><strong>My Tasks</strong></h3>
                        </div>
                        <ol class="list-group list-group-numbered">
                            @foreach($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-right">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"> <strong>{{ $task->todo_title }}</strong></div>
                                        <p class="cut-paragraph">{{ $task->todo_content }}</p>
                                    </div>
                                    <span>
                                        <div class="dropdown">
                                            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item no-padding" href="tasks/{{$task->id}}/edit">
                                                    <button class="btn btn-light transparent btn-block" type="submit"> View / Edit </button>
                                                </a>
                                                <div class="dropdown-item no-padding">            
                                                    <form method="POST" action="/tasks/{{ $task->id }}/important">
                                                        @method('PUT')
                                                        @csrf
                                                        <button class="btn btn-light transparent btn-block" type="submit"> Pin </button>
                                                    </form>
                                                </div>
                                                <div class="dropdown-item no-padding">            
                                                    <a href="/sendhtmlemail/{{ $task->todo_title }}/{{ $task->todo_content }}/{{ $user->name }}">
                                                        <button class="btn btn-light transparent btn-block" type="submit"> Share </button>
                                                    </a>
                                                </div>
                                                <div class="dropdown-item no-padding">
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-light btn-block danger" type="submit"> Delete </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <div class="col">
                    <form method="POST" action="/tasks" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control mb-2 @error('todo_title') is-invalid @enderror" id="todo_title" value="{{old ('todo_title')}}" name="todo_title" placeholder="Type Title here..">
                            </div>
                            @error('todo_title')
                                <p role="alert" class="alert alert-dark">{{ $message }}</p>
                            @enderror
                            <textarea class="form-control mb-2 @error('todo_content') is-invalid @enderror" value=" {{old ('todo_content') }} " id="todo_content"  name="todo_content" placeholder="Type content here.." style="height: 440px"></textarea>
                            @error('todo_content')
                                <p role="alert" class="alert alert-dark">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="shadow-sm p-3 mb-2">
                            <div class="row">
                                <div class="col-sm-1 mt-2 mr-3">
                                    <input class="hidden" name="img" id="upload" type="file"/>
                                    <a href="" class="text-decor-null" id="upload_link"><i class="far fa-images fa-2x icon-task-setting text-decor-null"></i></a>
                                </div>
                                <div class="col-sm-6">
                                    <input class="date datepicker-style form-control" name="todo_deadline" type="text" placeholder="Set Deadline">
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><strong>Save</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Pinned Task Part -->
                <div class="col">
                    <div class="set-height-pinned-task border">
                        <div class="p-3 sticky-top border set-bg-white">
                            <h3 class="text-center header-size"><strong>Pinned Tasks</strong></h3>
                        </div>
                        <ol class="list-group list-group-numbered">
                            @foreach ($pinnedTasks as $pinnedtask)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><strong>{{$pinnedtask->todo_title}}</strong></div>
                                    <p class="cut-paragraph">{{$pinnedtask->todo_content}}</p>
                                </div>
                                <span>
                                    <div class="dropdown">
                                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item no-padding" href="tasks/{{$pinnedtask->id}}/edit">
                                                <button class="btn btn-light transparent btn-block" type="submit">
                                                    View / Edit
                                                </button>
                                            </a>
                                            <div class="dropdown-item no-padding">            
                                                <form method="POST" action="/tasks/{{ $pinnedtask->id }}/notimportant">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn btn-light transparent btn-block" type="submit">
                                                        Unpin
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="dropdown-item no-padding">            
                                                <form method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn btn-light transparent btn-block" type="submit"> Share </button>
                                                </form>
                                            </div>
                                            <div class="dropdown-item no-padding">
                                                <form action="{{ route('tasks.destroy', $pinnedtask->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-light btn-block" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </li>
                            @endforeach
                        </ol>
                    </div>       
                    <br>

                    <!-- Missed Tasks -->
                    <div class="set-height-pinned-task border">
                        <div class="p-3 sticky-top border set-bg-white">
                            <h3 class="text-center header-size"><strong>Notification</strong></h3>
                        </div>
                        <ol class="list-group list-group-numbered">
                            @foreach ($upcomingTasks as $upcoming)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><strong>{{$upcoming->todo_title}}</strong>
                                        <span class="badge badge-primary">Upcoming</span>
                                    </div>
                                        <p class="cut-paragraph">{{$upcoming->todo_content}}</p>
                                </div>
                                <span>
                                    <div class="dropdown">
                                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item no-padding" href="tasks/{{$upcoming->id}}/edit">
                                            <button class="btn btn-light transparent btn-block" type="submit">View / Edit</button>
                                        </a>
                                          <div class="dropdown-item no-padding">  
                                            <form method="POST" action="/tasks/{{ $upcoming->id }}/important">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-light transparent btn-block" type="submit">Pin</button>
                                            </form>
                                          </div>
                                            <div class="dropdown-item no-padding">
                                                <form action="{{ route('tasks.destroy', $upcoming->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-light btn-block" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                      </div>
                                </span>
                            </li>
                            @endforeach
                        </ol>
                        
                        <ol class="list-group list-group-numbered">
                            @foreach ($ongoingTasks as $ongoing)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><strong>{{$ongoing->todo_title}}</strong>
                                        <span class="badge badge-success">Ongoing</span></div>
                                    <p class="cut-paragraph">{{$ongoing->todo_content}}
                                    </p>
                                </div>
                                <span>
                                    <div class="dropdown">
                                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item no-padding" href="tasks/{{$ongoing->id}}/edit">
                                            <button class="btn btn-light transparent btn-block" type="submit">View / Edit</button>
                                        </a>
                                          <div class="dropdown-item no-padding">            
                                            <form method="POST" action="/tasks/{{ $ongoing->id }}/important">
                                                @method('PUT')
                                                @csrf
                                                <button class="btn btn-light transparent btn-block" type="submit">Pin</button>
                                            </form>
                                          </div>
                                            <div class="dropdown-item no-padding">
                                                <form action="{{ route('tasks.destroy', $ongoing->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-light btn-block" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </li>
                            @endforeach
                        </ol>

                        <ol class="list-group list-group-numbered">
                            @foreach ($missedTasks as $missed)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><strong>{{$missed->todo_title}}</strong>
                                        <span class="badge badge-danger">Missed</span>
                                    </div>
                                    <p class="cut-paragraph">{{$missed->todo_content}}</p>
                                </div>
                                <span>
                                    <div class="dropdown">
                                        <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item no-padding" href="tasks/{{$missed->id}}/edit">
                                                <button class="btn btn-light transparent btn-block" type="submit">View / Edit</button>
                                            </a>
                                            <div class="dropdown-item no-padding">    
                                                <form method="POST" action="/tasks/{{ $missed->id }}/important">
                                                    @method('PUT')
                                                    @csrf
                                                    <button class="btn btn-light transparent btn-block" type="submit">Pin</button>
                                                </form>
                                            </div>
                                            <div class="dropdown-item no-padding">
                                                <form action="{{ route('tasks.destroy', $missed->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-light btn-block" type="submit"> 
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('.date').datepicker({format: 'yyyy-mm-dd'});  
        </script> 
    </body>
</html>