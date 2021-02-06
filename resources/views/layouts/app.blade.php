<!DOCTYPE html>
<htm lang="{{ str_replace('_', '-', app()->getLocale()) }}"l>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
</head>
<body>
	<nav class="light-blue lighten-1">
    <div class="nav-wrapper container">
      <a href="{{ route('index') }}" class="brand-logo">ToDo App</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="{{ route('todo') }}">Todos</a></li>
        @auth
          <li><a onclick="$('#logout-form').submit()">Logout</a></li>
          <form id="logout-form" action="{{ route('logout-user') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endauth
        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
        @endguest
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="{{ route('todo') }}">Todos</a></li>
        @auth
          <li><a href="collapsible.html">Logout</a></li>
        @endauth
        @guest
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
        @endguest
      </ul>
    </div>
  </nav>
  @yield('content')
</body>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="/js/sweetalert.min.js"></script>
  <script src="/js/app.js"></script>
  @yield('scripts')
</html>