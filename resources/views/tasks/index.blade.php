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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">  
        <link type="text/css" rel="stylesheet" href="{{ asset('css/home.css') }}">

    </head>

    <body>
        <nav class="navbar sticky-top navbar-light p-3 mb-3 set-bg-white" style="box-shadow: 0px 1px 10px #999;">
            <div class="container-fluid">
                <a class="navbar-brand"><strong>ToDo - WEB APPLICATION</strong></a>
                <div class="d-flex">
                    <a class="nav-link black" href="">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center align-items-start">
                <div class="col">
                    <form method="POST" action="/tasks">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="searchInput" id="searchInput" class="form-control" placeholder="Search task here..">
                            <button type ="submit" class="input-group-text">
                                <i class="fas fa-search icons-setting"></i>
                            </button>
                        </div>
                    </form>
                
                <div class="set-height-tasks border" >
                    <div class="p-3 sticky-top border set-bg-white">
                        <h3 class="text-center header-size"><strong>Tasks</strong></h3>
                    </div>
                    <ol class="list-group list-group-numbered">
                        @foreach($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-right">
                 
                                <div class="ms-2 me-auto">
                                        <div class="fw-bold"> <strong>{{ $task->todo_title }}</strong></div>
                                        {{ $task->todo_content }}
                                </div>
                         
                            <span class ="task-icons">
                                <a href="tasks/{{$task->id}}/edit">  
                                    <i class="fal fa-pencil mr-2 icons-setting"></i> 
                                </a>
                                
                                <form method="POST" action="/tasks/{{ $task->id }}/important">
                                    @method('PUT')
                                        @csrf
                                    <button type="submit">
                                        <i class="fal fa-thumbtack mr-2 icons-setting"></i>
                                    </button>
                                </form>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                     <button type="submit"> <i class="far fa-trash-alt icons-setting"></i> </button>
                                </form>
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
                                <input type="text" class="form-control mb-2" id="todo_title" name="todo_title" placeholder="Type Title here..">
                            </div>
                                <textarea class="form-control" id="todo_content" name="todo_content" placeholder="Type content here.." style="height: 440px"></textarea>
                        </div>
                        <div class="shadow-sm p-3">
                            <div class="row">
                                <div class="col-sm-1 mt-2 mr-3">
                                    <input class="hidden" name="img" id="upload" type="file"/>
                                    <a href="" class="text-decor-null" id="upload_link"><i class="far fa-images fa-2x icon-task-setting text-decor-null"></i></a>
                                </div>
                                <div class="col-sm-5">
                                    <input class="date form-control" name="todo_deadline" type="text" placeholder="Select Date">
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><strong>Save</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col">
        
                    <!-- Pinned Task Part -->
                    <div class="set-height-pinned-task border">
                        <div class="p-3 sticky-top border set-bg-white">
                            <h3 class="text-center header-size"><strong>Pinned Tasks</strong></h3>
                        </div>
                        <ol class="list-group list-group-numbered">
                            @foreach ($pinnedTasks as $pinnedtask)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{$pinnedtask->todo_title}}</div>
                                    {{$pinnedtask->todo_content}}
                                </div>
                                <span class ="task-icons">
                                    <a href="tasks/{{$pinnedtask->id}}/edit">  
                                        <i class="fal fa-pencil mr-2 icons-setting"></i> 
                                    </a>
                                    <form method="POST" action="/tasks/{{ $pinnedtask->id }}/notimportant">
                                        @method('PUT')
                                        @csrf
                                        <button type="submit">
                                            <i class="fas fa-thumbtack icons-setting"></i>
                                        </button>
                                    </form> 
                                    <form action="{{ route('tasks.destroy', $pinnedtask->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        <button type="submit"> <i class="far fa-trash-alt icons-setting"></i> </button>
                                    </form>
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
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Cras justo odio
                                </div>
                                <span>
                                    <i class="fad fa-exclamation-circle mr-2 icons-setting"></i>   
                                    <i class="far fa-trash-alt icons-setting"></i>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Cras justo odio
                                </div>
                                <span>
                                    <i class="fad fa-exclamation-circle mr-2"></i>
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Cras justo odio
                                </div>
                                <span>
                                    <i class="fad fa-exclamation-circle mr-2"></i>
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Cras justo odio
                                </div>
                                <span>
                                    <i class="fad fa-exclamation-circle mr-2"></i>
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </li>
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