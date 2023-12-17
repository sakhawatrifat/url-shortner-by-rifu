<div class="nk-sidebar-element nk-sidebar-head">
    <div class="nk-sidebar-brand">
        <a href="{{route('admin.home')}}" class="logo-link nk-sidebar-logo">
            <img class="logo-dark logo-img" src="{{asset('logo.png')}}" srcset="{{asset('logo.png')}}" alt="logo">
        </a>
    </div>
    <div class="nk-menu-trigger mr-n2">
        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
    </div>
</div><!-- .nk-sidebar-element -->
<div class="nk-sidebar-element">
    <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">

                <!--/nk-menu-item start -->
                <li class="nk-menu-item">
                    <a href="{{route('user.profile')}}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                        <span class="nk-menu-text">Generate Url</span>
                    </a>
                </li>
                <!--/nk-menu-item end -->

                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-link-alt"></em></span>
                        <span class="nk-menu-text">URL's</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="{{route('user.url.index')}}" class="nk-menu-link"><span class="nk-menu-text">Manage URL's</span></a>
                        </li>
                    </ul>
                </li>

           	</ul> <!-- nk-menu -->
        </div><!-- nk-sidebar-menu -->
    </div><!-- nk-sidebar-content -->
</div><!-- nk-sidebar-element -->