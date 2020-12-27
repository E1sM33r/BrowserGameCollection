<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrowserGameCollection</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
<nav class="p-6 bg-white flex justify-between mb-6">
    <ul class="flex items-center">
        <li>
            <a href="{{ route('home') }}" class="p-3">Home</a>
        </li>
        <li>
            <a href="{{ route('highscores') }}" class="p-3">Highscores</a>
        </li>
    </ul>

    <div class="w-3/12">
        <form action="{{ route('results') }}" method="get">
            <input type="text" placeholder="Suchen..." name="searchField" class="w-3/4 bg-gray-200 rounded-lg p-1">
            <button class="" type="submit" value="search">
                Suchen
            </button>
        </form>
    </div>

    <ul class="flex items-center">
        @auth
            <li>
                <a href="" class="p-3">{{auth()->user()->username}}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
        @endguest




    </ul>
</nav>
@yield('content')
</body>
</html>
