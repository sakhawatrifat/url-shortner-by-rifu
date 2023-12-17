<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
    <!-- Page Title  -->
    <title>{{ str_replace('_', ' ', config('app.name', 'Url Shortner')) }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- StyleSheets  -->
    @include('_commonPartials.stylesheets')
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                @include('backend._partials.sidebar')
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    @include('backend._partials.header')
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    {{-- For Append,Ajax Call etc. --}}
                    <div class="c-preloader" style="display: none">
                        <div class="c-loader"></div>
                    </div>
                    
                    {{-- Common Errors Start --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-1 common-message-section">
                           <ul class="m-0">
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                        </div>
                    @endif

                    @if(Session::has('cWarning'))
                      <div class="alert alert-warning mt-1 alert-dismissible fade show" role="alert">
                          {{Session::has('cWarning') ? Session::get('message') : ''}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"></span>
                          </button>
                      </div>
                    @endif

                    @if(Session::has('cSuccess'))
                      <div class="alert alert-success mt-1 alert-dismissible fade show" role="alert">
                          {{Session::has('cSuccess') ? Session::get('message') : ''}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"></span>
                          </button>
                      </div>
                    @endif
                    {{-- Common Errors End --}}
                    @yield('content')
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                   @include('backend._partials.footer') 
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    @include('_commonPartials.scripts')
    @include('_commonPartials.messages')
    @stack('scripts')
</body>

</html>