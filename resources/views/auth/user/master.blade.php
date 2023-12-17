<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
        <!-- Page Title  -->
        <title>{{ str_replace('_', ' ', config('app.name', 'Url Shortner')) }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- StyleSheets  -->
        @include('_commonPartials.stylesheets')
        <!-- Frontend Theme StyleSheets  -->
        <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
        <style>
            button{
                margin:0;
            }
            body{
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                justify-content: space-between;
                padding-top: 80px;
                transition: all .3s ease;
                position: relative;
            }
            .auth-content-wrapper {
                padding: 30px 0;
                padding-bottom: 80px;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .auth-form-card {
                padding: 25px!important;
            }
            .c-alert .text-sm {
                font-size: 18px;
            }   
            @media(max-width: 1024px){
                .auth-form-bottom {
                    flex-wrap: wrap;
                    justify-content: center!important;
                    margin-bottom: 15px!important;
                }

                .auth-form-bottom a {
                    margin: 0!important;
                }

                .auth-form-bottom .form-check {
                    width: 100%;
                    margin-bottom: 10px;
                }
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- header start -->
        <header id="header" class="menu-container">
            <div class="container">
            <div class="header-inner">
                <!-- Logo -->
                <div class="logo-box">
                    <a href="{{route('home')}}" class="logo-link">
                        <img class="logo-img" src="{{asset('logo.png')}}" srcset="{{asset('logo.png')}}" alt="logo">
                    </a>
                </div>
                <!-- Logo -->

                <!-- navbar -->
                <nav id="nav-bar">
                    <input class="menu-btn" type="checkbox" id="menu-btn" />
                    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
                    <ul class="menu">
                        <li><a href="#about" class="nav-link">About</a></li>
                        <a class="highlight" href="{{route('user.profile')}}">Getting Started</a>
                    </ul>
                </nav>
                <!-- navbar -->
                </div>
            </div>
        </header>
        <!-- header ends -->

        <div class="wrapper">
            <!-- Content Wrapper. Contains page content -->
            <div class="auth-content-wrapper">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-10 m-auto">
                    <div class="card card-default rounded border p-5 auth-form-card">
                        @if ($errors->any())
                            <div class="alert-items-wrap mb-10">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger d-flex c-alert align-items-center px-2 py-1 mb-4">
                                        <span class="d-flex align-items-center">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-0 text-sm">{{$error}}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <!--Errors/Warning end-->

                        <!--Success start-->
                        @if(Session::get('success'))
                            <div class="alert alert-success d-flex align-items-center p-1">
                                <span class="d-flex align-items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-sm"></h4>
                                    <span>{{ Session::get('message') }}</span>
                                </div>
                            </div>
                        @endif
                        <!--Success end-->

                        <!--Info start-->
                        @if(Session::get('message'))
                            <div class="alert alert-info d-flex align-items-center p-1">
                                <span class="d-flex align-items-center">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor" />
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-sm"></h4>
                                    <span>{{ Session::get('message') }}</span>
                                </div>
                            </div>
                        @endif
                        <!--Info end-->
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->

        <footer class="text-center">
            <div class="container">
                <p>&copy; All Right Reserved By Sakhawat Rifat, {{date('Y')}}</p>
            </div>
        </footer>

        <!-- REQUIRED SCRIPTS -->
        @include('._commonPartials.scripts')
        @include('._commonPartials.messages')
        @stack('scripts')
        <script type="text/javascript">
            //JS for header padding top...
            setTimeout(function(){
              $("body").css({"padding-top": `${$('#header').height()+20}px`});
            },500);
        </script>
    </body>
</html>
