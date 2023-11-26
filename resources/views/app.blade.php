<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/index.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>Album Photo</title>
</head>
<body>
    <nav>
        <a href="{{route("home")}}">Home</a>
        <a href="{{route("albumIndex")}}">Les albums</a>
        <a href="{{route("tagIndex")}}">Catégories</a>
        @auth
            <h3>Bonjour {{Auth::user()->name}}</h3>
            <a href="{{route("logout")}}"
            onclick="document.getElementById('logout').submit(); return false;">Logout</a>
            <form id="logout" action="{{route("logout")}}" method="post">
                @csrf
            </form>
        @else
            <a href="{{route("login")}}">Login</a>
            <a href="{{route("register")}}">Register</a>
        @endauth
    </nav>
    <main>
    @yield('content')
    </main>
    <footer></footer>
</body>
</html>
