<!doctype html>
<html lang="en">

<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{ asset('images/fav.png') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('css/auth-style.css') }}">

</head>

<body>

    <div>
        @yield('content')
    </div>

    <script src="{{ asset('js/auth/jquery.min.js') }}"></script>
	<script src="{{asset('js/auth/popper.js')}}"></script>
	<script src="{{asset('js/auth/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/auth/main.js')}}"></script>

</body>

</html>