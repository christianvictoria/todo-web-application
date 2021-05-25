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
                    <a href="/tasks">
                        <button type="button" class="btn btn-primary">Tasks</button>
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
               <div class="row justify-content-end items-end">
                    <div class=".col-md-4 .offset-md-4">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Shared Tasks</a>
                                <a class="dropdown-item" href="#">Shared with me</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center items-start">
                    <div class="col-8">
                        <div class="set-height-tasks border" style="margin-top: -10px;">
                            <div class="p-3 sticky-top border set-bg-white">
                                <h3 class="text-center header-size"><strong>Shared Tasks</strong></h3>
                            </div>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-right">
                                    <div class="ms-2 me-auto">
                                        <div class="d-flex w-100 justify-content-between">
                                           <h5 class="mb-1">List group item heading</h5>
                                            <!-- <small class="text-muted">3 days ago</small> -->
                                        </div>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus.</p>
                                        <strong><p>You shared this Task to Daryl*</p></strong>
                                    </div>
                                    <span>
                                    <div class="dropdown">
                                            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item no-padding">
                                                    <button class="btn btn-light transparent btn-block" type="submit"> View / Edit </button>
                                                </a>
                                            </div>
                                        </div>
                                    </span>
                                </li> 
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>