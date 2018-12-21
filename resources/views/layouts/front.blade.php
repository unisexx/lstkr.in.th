<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ url('/') }}/"  />
    <!-- Meta & Css -->
    @include('include.front.meta')
</head>

<body id="app-layout">
    <!-- Header -->
    @include('include.front.header')

    <div class="container">
    	<div class="row">
    		<!-- <div class="col-6 col-md-2 sidebar-offcanvas" id="sidebar">
                @include('include.front.sidebar')
        	</div> -->
        	<div class="col-md-10 col-md-offset-1" style="">
    			@yield('content')
    		</div>
        </div>
	</div>
	
	<!-- Main Footer -->
    @include('include.front.footer')
    
    <!-- JavaScripts -->
    @include('include.front.js')
</body>
</html>

