<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Coffee</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="../assets/css/linearicons.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>

    <header id="header" id="home">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-sm-4 col-8 header-top-right no-padding">
                        <ul>
                            <li>
                                Mon-Fri: 8am to 2pm
                            </li>
                            <li>
                                Sat-Sun: 11am to 4pm
                            </li>
                            <li>
                                <a href="tel:(012) 6985 236 7512">(012) 6985 236 7512</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="#"><img src="img/logo.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#coffee">Menu</a></li>
                        <li><a href="#review">Review</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" class="btn btn-primary">Login</a></li>
                        @endguest
                        @auth
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <a>Halo {{auth()->user()->name }}, </a> 
                                    <input type="submit" value="Logout">
                                </form>
                            </li>
                            
                        @endauth
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->

    @yield('container')

    @include('layouts.footer')

    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="../assets/js/easing.min.js"></script>
    <script src="../assets/js/hoverIntent.js"></script>
    <script src="../assets/js/superfish.min.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/parallax.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>