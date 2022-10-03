<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliverBoo - Pannello Utente</title>

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">HomePage</a>
            <ul class="navbar-nav px-3 ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.plates.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Menù
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.plates.create') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Aggiungi un nuovo piatto
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.users.edit') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Modifica dati utente
                                </a>
                            </li>
                        </ul>
    
                    </div>
                </nav>
    
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <div class="safe d-none" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Sei sicuro di voler cancellare questo piatto?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="Chiudi" onclick="closeModal()">
                        @yield('delete')
                    </div>
                </div>
            </div>
        </div>

       
        <div class="green-pop d-none" id="pop">
            <div class="modal-dialog rounded-3">
                <div class="modal-content bg-success">
                    <div class="modal-body text-center" style="color: white">
                        <p class="mb-0">Modal body text goes here.</p>
                    </div>
                </div>
            </div>
        </div>
 

     

        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/back.js') }}" defer></script>
    <script src="{{ asset('js/showmodal.js') }}" defer></script>
    

</body>
</html>