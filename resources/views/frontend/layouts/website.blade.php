<!DOCTYPE html>
<html>
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
</head>

<body>
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

	@yield('content')

	<footer class="text-center">
		<div class="container">
			<p>&copy; All Right Reserved By Sakhawat Rifat, {{date('Y')}}</p>
		</div>
	</footer>

	@include('._commonPartials.scripts')
    @include('._commonPartials.messages')
    @stack('scripts')
    <script>
    	$(document).on('click', '.menu-icon', function(){
    		$('body').toggleClass('menu-toggled');
    	})

    	//JS for header padding top...
		$(document).ready(function(){
		  	setTimeout(function(){
		      	$(".page-featured-content").css({"padding-top": `${$('#header').height()+20}px`});
		    },500);
		});
    </script>
</body>
</html>