<!DOCTYPE html>
<html lang="en" data-ng-app="shop">
<head>
    <title>
        @yield('title') | Fashion
    </title>
    @include('back-end.shared.head')
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        	<!-- Navigation -->
        		@include('back-end.shared.navbar')
        	<!-- End Navigation -->

        	<!-- Side bar -->
        		@include('back-end.shared.sidebar')
        	<!-- End Side bar -->
        	
        </nav>

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
	@include('back-end.shared.script')
</html>
