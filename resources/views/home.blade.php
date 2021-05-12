<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ToDo - WebApp</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />  

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<nav class="navbar sticky-top navbar-light p-3 mb-3 set-bg-white" style="box-shadow: 0px 1px 10px #999;">
    <div class="container-fluid">
        <a class="navbar-brand"><strong>ToDo - WEB APPLICATION</strong></a>
        <div class="d-flex">
            <a class="nav-link black" href="">Logout</a>
        </div>
    </div>
</nav>

<div class="container">

    <!-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div> 
        </div> -->

    <div class="row justify-content-center align-items-start">
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search task here..">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>

            <div class="set-height-tasks border" >
                <div class="p-3 sticky-top border set-bg-white">
                    <h3 class="text-center header-size"><strong>My Tasks</strong></h3>
                </div>
            <ol class="list-group list-group-numbered">
                @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $task->todo_title }}</div>
                        {{ $task->todo_content }}
                    </div>
                    <span>
                        <i class="fal fa-thumbtack mr-2 icons-setting"></i>
                        <i class="far fa-trash-alt icons-setting"></i>
                    </span>
                </li>
                @endforeach
            </ol>
        </div>

        </div>
        <div class="col">
            <div>
            <div class="input-group">
                <input type="text" class="form-control mb-2" placeholder="Type Title here..">
            </div>
                <textarea class="form-control" placeholder="Type content here.." style="height: 440px"></textarea>
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
                        <button type="button" class="btn btn-primary"><strong>Save</strong></button>
                    </div>
                  </div>

            </div>
        </div>
        <div class="col">

            <!-- Pinned Task Part -->
            <div class="set-height-pinned-task border">
                <div class="p-3 sticky-top border set-bg-white">
                    <h3 class="text-center header-size"><strong>Pinned Tasks</strong></h3>
                </div>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Cras justo odio
                        </div>
                        <span>
                            <i class="fas fa-thumbtack icons-setting"></i>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Cras justo odio
                        </div>
                        <span>
                            <i class="fas fa-thumbtack"></i>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Cras justo odio
                        </div>
                        <span>
                            <i class="fas fa-thumbtack"></i>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Subheading</div>
                            Cras justo odio
                        </div>
                        <span>
                            <i class="fas fa-thumbtack"></i>
                        </span>
                    </li>
                </ol>
            </div>

            <br>
            <!-- Missed Tasks -->
            <div class="set-height-pinned-task border">
                <div class="p-3 sticky-top border set-bg-white">
                    <h3 class="text-center header-size"><strong>Missed Tasks</strong></h3>
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

</html>