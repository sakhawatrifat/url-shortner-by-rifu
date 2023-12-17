<div class="container-fluid">
    <div class="nk-header-wrap">
        <div class="nk-menu-trigger d-xl-none ml-n1">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-header-brand d-xl-none">
            <a href="html/index.html" class="logo-link">
                <img class="logo-img" src="{{asset('logo.png')}}" srcset="{{asset('logo.png')}}" alt="logo">
            </a>
        </div><!-- .nk-header-brand -->
        <div class="nk-header-search ml-3 ml-xl-0">
            {{-- <em class="icon ni ni-search"></em>
            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything"> --}}
        </div><!-- .nk-header-news -->
        <div class="nk-header-tools">
            <ul class="nk-quick-nav">
                <li class="">
                    <a class="lead-text-lg pr-2" title="Browse Website" href="{{route('home')}}" target="_blank">
                        <h3 class="mb-0"><em class="icon ni ni-globe ni-2x"></em></h3>
                    </a>
                </li>
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                        <div class="user-toggle">
                            <div class="user-avatar sm">
                                @if(Auth::user()->image)
                                    <img style="height: 100%;width: 100%;object-fit: cover;" src="{{asset(Auth::user()->image)}}">
                                @else
                                    <em class="icon ni ni-user-alt"></em>
                                @endif
                            </div>
                            <div class="user-info d-none d-xl-block">
                                <div class="user-name dropdown-indicator">{{Auth::user()->name}}</div>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                            <div class="user-card">
                                <div class="user-avatar">
                                    @if(Auth::user()->image)
                                        <img style="height: 100%;width: 100%;object-fit: cover;" src="{{asset(Auth::user()->image)}}">
                                    @else
                                        <span>{{Auth::user()->name[0]}}</span>
                                    @endif
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{Auth::user()->name}}</span>
                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                {{-- <li><a href="{{route('admin.profile-edit',Auth::user()->id)}}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li> --}}
                                {{-- <li><a href=""><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> --}}
                                {{-- <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> --}}
                            </ul>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <em class="icon ni ni-signout"></em>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div><!-- .nk-header-wrap -->
</div><!-- .container-fliud -->