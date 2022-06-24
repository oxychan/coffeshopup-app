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
                    <li class="menu-active"><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.menus') }}">Menu</a></li>
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    @guest
                    <li><a href="{{ route('login') }}" class="btn text-white" style="font-size: 14px; background-color: #b68834;">Login</a></li>
                    @endguest
                    @auth
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <a class="text-white">Halo {{auth()->user()->name }}, </a>
                            <input class="btn text-white mx-1" style="font-size: 14px; background-color: #b68834;" type="submit" value="Logout">
                        </form>
                    </li>

                    @endauth
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header><!-- #header -->