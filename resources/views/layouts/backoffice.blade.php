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

    {{-- Chart.js cdns --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script> --}}

    {{-- Script --}}
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md flex-md-nowrap p-1 fixed-top">
            <div class="logo">
                <img class="back-logo" src="../../images/Deliver-removebg-preview.png" alt="logo">
            </div>
           
            <ul class="navbar-nav px-3 ml-auto">
                <li class="nav-item">
                    <a class="nav-link logout" href="{{ route('logout') }}"
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
            <div class="row mt-5">
                <nav class="col-md-2 d-none d-md-block sidebar py-4 position-fixed">
                    <div class="sidebar-sticky left-navbar-admin">
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item-admin">
                                <a class="nav-link active" href="{{ route('admin.home') }}">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                     --}}
                                     <lord-icon
                                         src="https://cdn.lordicon.com/tbfrtmlu.json"
                                         trigger="loop"
                                         delay="2000"
                                         style="width:50px;height:50px">
                                     </lord-icon>
                                    Profilo e statistica
                                </a>
                            </li>
                            <li class="nav-item-admin">
                                <a class="nav-link active" href="{{ route('admin.plates.index') }}">
                                    {{-- <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script> --}}
                                    <lord-icon
                                        src="https://cdn.lordicon.com/vwlhfdnm.json"
                                        trigger="loop"
                                        delay="2000"
                                        style="width:50px;height:50px">
                                    </lord-icon>
                                    Menù
                                </a>
                            </li>
                            <li class="nav-item-admin">
                                <a class="nav-link active" href="{{ route('admin.plates.create') }}">
                                    {{-- <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script> --}}
                                    <lord-icon
                                        src="https://cdn.lordicon.com/zgogqkqu.json"
                                        trigger="loop"
                                        delay="2000"
                                        style="width:50px;height:50px">
                                    </lord-icon>
                                    Aggiungi piatto
                                </a>
                            </li>
                            <li class="nav-item-admin">
                                <a class="nav-link active" href="{{ route('admin.users.edit') }}">
                                    {{-- <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script> --}}
                                    <lord-icon
                                        src="https://cdn.lordicon.com/ljvjsnvh.json"
                                        trigger="loop"
                                        delay="2000"
                                        style="width:50px;height:50px">
                                    </lord-icon>
                                    Modifica dati utente
                                </a>
                            </li>
                            <li class="nav-item-admin">
                                <a class="nav-link active" href="{{ route('admin.orders.index') }}">
                                    {{-- <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script> --}}
                                    <lord-icon
                                        src="https://cdn.lordicon.com/wvqpnihn.json"
                                        trigger="loop"
                                        delay="2000"
                                        style="width:50px;height:50px">
                                    </lord-icon>
                                    I tuoi Ordini
                                </a>
                            </li>
                        </ul>
    
                    </div>
                </nav>
    
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4 mt-5">
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

       
        
 

     

        
    </div>

    <!-- Scripts -->
    @yield('script')
    <script src="{{ asset('js/back.js') }}" defer></script>
    <script src="{{ asset('js/showmodal.js') }}" defer></script>
    
    

</body>
</html>