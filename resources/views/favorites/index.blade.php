@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            @if (session('status'))
                <div class="bg-blue-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-2xl font-medium py-2 px-4">Meine Favoriten</p>

            @if ($games->count())

                <div class="grid gap-4 grid-cols-3 pb-2" id="app">
                    @foreach($games as $game)

                        <div class="bg-gray-100 rounded-lg p-1 m-4">
                            <a href="{{route('game.show', $game->id)}}">
                                <div class="flex flex-col items-center">
                                    <p class="p-1">
                                        <span class="font-medium text-lg">{{$game->title}}</span>
                                        <span class="">von {{$game->developer}}</span>
                                    </p>

                                    <img src="{{$game->gameImage()}}" class="w-11/12 py-1">

                                    <div class="flex">
                                        <star-rating :rating="{{ round($game->averageRating(), 2) }}" :read-only="true" :increment="0.01" :star-size="30"></star-rating>
                                        <p class="p-2">({{$game->usersRated()}} Bewertungen)</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>

                {{ $games->links() }}
            @else
                    <p class="p-4 text-lg">Keine Favoriten gefunden</p>
            @endif
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
