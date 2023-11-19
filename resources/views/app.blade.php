<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/index.js"></script>
    <title>Album Photo</title>
</head>
<body>
    <nav>
        <a href="{{route("home")}}">Home</a>
        <a href="{{route("albumIndex")}}">Les albums</a>
        <a href="{{route("tagIndex")}}">Catégories</a>
    </nav>
    <main>
    @yield('content')
    </main>
    <footer></footer>
</body>
</html>
