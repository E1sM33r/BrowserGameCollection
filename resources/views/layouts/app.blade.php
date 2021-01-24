<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BrowserGameCollection</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.50.0/dist/phaser-arcade-physics.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-500">
<nav class="p-6 bg-gray-700 flex justify-between mb-6" x-data="{showSearchModal:false}" x-bind:class="{ 'model-open': showSearchModal }">
    <ul class="flex items-center">
        <li>
            <a href="{{ route('home') }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Home</a>
        </li>
        <li>
            <a href="{{ route('highscores') }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Highscores</a>
        </li>
        @auth
        <li>
            <a href="{{ route('favorites') }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Favoriten</a>
        </li>
        @endauth
    </ul>

    <div class="w-3/12">
        <form action="{{ route('results') }}" method="get">
            @CSRF
            <button class="bg-gray-400 hover:bg-gray-500 text-white hover:text-white rounded-l-lg p-1" type="button" value="search" @click={showSearchModal=true}>V</button>
            <input type="text" placeholder="Suchen..." name="search" class="w-3/4 bg-gray-200 p-1">
            <button class="bg-gray-400 hover:bg-gray-500 text-white hover:text-white rounded-r-lg p-1" type="submit" value="search">Suchen</button>
        </form>
    </div>

    <ul class="flex items-center">
        @auth
            <li>
                <a href="{{ route('profiles.show', auth()->user()->username) }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">{{auth()->user()->username}}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="m-2 inline">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded p-1">Logout</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-1 m-2 bg-blue-600 hover:bg-blue-700 text-white hover:text-white rounded">Register</a>
            </li>
        @endguest
    </ul>

    <!-- Extended Search modal -->
    <div x-show="showSearchModal" tabindex="0"
         class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
        <div @click.away="showSearchModal = false" class="z-50 relative p-3 mx-auto my-0 max-w-full"
             style="width: 1000px;">
            <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden px-10 py-10">
                <div class="text-center py-3 text-3xl text-gray-700 font-medium">Erweiterte Suche</div>
                <div class="text-center text-lg font-light text-gray-700 mb-8">

                    <form action="{{ route('results') }}" method="get" id="extendedSearch" class="pt-4">
                        <input type="text" placeholder="Suchenbegriff eingeben..." name="search" class="w-10/12 rounded-lg bg-gray-200 p-1">
                        <p class="font-medium pt-4">Tags</p>

                        <p class="underline">Genre</p>
                        <div>
                            <label for="JumpnRun" class="pr-2">Jump&Run</label>
                            <input type="checkbox" name="tagsGenre[]" id="JumpnRun" class="bg-gray-100 border-2 p-4 rounded-lg" value="Jump&Run">
                            <label for="Arcade" class="px-4">Arcade</label>
                            <input type="checkbox" name="tagsGenre[]" id="Arcade" class="bg-gray-100 border-2 p-4 rounded-lg" value="Arcade">
                            <label for="Shooter" class="px-4">Shooter</label>
                            <input type="checkbox" name="tagsGenre[]" id="Shooter" class="bg-gray-100 border-2 p-4 rounded-lg" value="Shooter">
                        </div>

                        <p class="underline">Steuerung</p>
                        <label for="Tastatur" class="pr-2">Tastatur</label>
                        <input type="checkbox" name="tagsControl[0]" id="Tastatur" class="bg-gray-100 border-2 p-4 rounded-lg" value="Tastatur">
                        <label for="Maus" class="pr-2">Maus</label>
                        <input type="checkbox" name="tagsControl[1]" id="Maus" class="bg-gray-100 border-2 p-4 rounded-lg" value="Maus">

                        <p class="underline">Highscore Typ</p>
                        <label for="Endlos" class="pr-2">Endlos</label>
                        <input type="checkbox" name="tagsType[0]" id="Endlos" class="bg-gray-100 border-2 p-4 rounded-lg" value="Endlos">
                        <label for="Zeitbegrenzt" class="pr-2">Zeitbegrenzt</label>
                        <input type="checkbox" name="tagsType[1]" id="Zeitbegrenzt" class="bg-gray-100 border-2 p-4 rounded-lg" value="Zeitbegrenzt">
                    </form>

                </div>
                <div class="flex justify-center">
                    <button @click={showSearchModal=false} class="bg-gray-300 text-gray-900 rounded hover:bg-gray-200 px-6 py-2 focus:outline-none mx-1">Abbrechen</button>
                    <button type="submit" form="extendedSearch" class="bg-blue-500 text-gray-200 rounded hover:bg-blue-400 px-6 py-2 focus:outline-none mx-1">Suchen</button>
                </div>
            </div>
        </div>
        <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
    </div>
</nav>
<div>
@yield('content')
</div>
@stack('scripts')
</body>
</html>
