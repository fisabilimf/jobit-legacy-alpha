<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.min.js') }}" defer></script>
    <script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/vue@2.6.14')}}"></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm sticky-top" style="background-color : #114386;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'JobIT') }} --}}
                    <img src="{{ asset('Logo.png') }}" alt="<strong>JobIT</strong>" srcset="" style="height: 30px">
                    {{-- <strong>{{ config('app.name', 'JobIT') }}</strong> --}}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            {{-- <a class="nav-link text-light" href="{{ route('employer.registration') }}">{{ __('Blog') }}</a> --}}
                            <a class="nav-link text-light" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                        {{-- <li class="nav-item"> --}}
                            {{-- <a class="nav-link text-light" href="{{ route('employer.registration') }}">{{ __('Blog') }}</a> --}}
                            {{-- <a class="nav-link text-light" href="{{ route('blog') }}">{{ __('Blog') }}</a> --}}
                        {{-- </li> --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @if (Route::has('employer.registration'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('employer.registration') }}">{{ __('Employer Register!') }}</a>
                                </li>
                                
                            @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-light dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->user_type == 'employer')
                                        {{Auth::user()->company->cname}}   {{-- jika login dengan akun company agar terlihat nama company di navbar --}}
                                    @endif
                                    @if (Auth::user()->user_type == 'seeker')
                                        {{ Auth::user()->name }}   {{-- user login menggunakan type seeker --}}
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->user_type=='employer')
                                        <a class="dropdown-item" href="{{ route('company.create') }}">
                                            {{ __('Company') }} 
                                        </a>
                                        <a class="dropdown-item" href="{{ route('jobs.myjobs') }}">
                                            {{ __('My Jobs') }} 
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('user.profile') }}">
                                            {{ __('Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            {{ __('Favorites Jobs') }}
                                        </a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @if(Auth::user()->user_type=='employer')
                                <li>
                                    <a href="{{route('jobs.create')}}">
                                        <button class="btn btn-success">Post Job</button>
                                    </a>
                                </li>
                            @endif
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        <div class="py-5"></div>
        <div class="py-5"></div>
        <div class="py-5"></div>
        <div class="pt-5 position-static">
            <footer class="fixed-bottom text-center text-lg-start footer" style="background-color: #1E385A; color : #FFFFFF; bottom: 0; position: relative;">
                <!-- Grid container -->
                <div class="container p-4">
                    <!--Grid row-->
                    <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-10 mb-4 mb-md-0">
                        <a href="{{ url('/') }}"><img src="{{ asset('Logo.png') }}" alt="<strong>JobIT</strong>" srcset="" style="width: 100px"></a>
                        <h5>Discover Your Dream Job!</h5>
                    </div>
                    <!--Grid column-->
            
                    <!--Grid column-->
                    <div class="mr-auto col-lg-3 col-md-4 mb-2 mb-md-0">
                        <h6 class="text-left">Tentang</h6>
                        <h6 class="text-left">Karir</h6>
                        <h6 class="text-left">Magang</h6>
                        <h6 class="text-left"><a class="text-light" href="{{ route('blog') }}">{{ __('Blog') }}</a></h5>
                        <h6 class="text-left">Kontak</h6>
                        <ul class="text-left list-unstyled mb-0">
                        <li>
                            <a href="#" class="text-light">
                                {{-- <i id="social" class="fa fa-instagram fa-1x"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>                        
                            </a> &emsp;
                            <a href="#" class="text-light">
                                {{-- <i id="social" class="fa fa-facebook fa-1x"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>                        
                            </a> &emsp;
                            <a href="#" class="text-light">
                                {{-- <i id="social" class="fa fa-twitter fa-1x"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>                        
                            </a> &emsp;
                            <a href="#" class="text-light">
                                {{-- <i id="social" class="fa fa-youtube fa-1x"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                </svg>                        
                            </a> &emsp;
                            <a href="#" class="text-light">
                                {{-- <i id="social" class="fa fa-linkedin fa-1x"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                </svg>                        
                            </a>
                        </li>
                        </ul>
                    </div>
                    <!--Grid column-->
            
                    <!--Grid column-->
                    <div class="col-lg-5 col-md-8 mb-6 mb-md-0">
                        <div class="row mx-auto">
                            <div class="col">
                                <h5 class="text-uppercase mb-0">Layanan newsletter</h5>
                            </div>
                        </div>
                        <div class="py-2"></div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-center" placeholder="example@mail.com" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                      <a class="btn btn-outline-success text-light" type="button" id="subscribe">Langganan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-light">Term of Use</a> &nbsp;
                            <a href="#!" class="text-light">Privacy Policy</a> &nbsp;
                            <a href="#!" class="text-light">Report a Problem</a>
                        </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                    </div>
                    <!--Grid row-->
                </div>
                <!-- Grid container -->
            
                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    © 2021 Copyright
                    <a class="text-light" href="#">&nbsp;<strong>JobIT</strong></a>
                </div>
                <!-- Copyright -->
            </footer>            
            

        </div>

    </div>

    <!-- Akhir Artikel -->
    <div>
        <!-- Footer -->

    </div>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
</html>
