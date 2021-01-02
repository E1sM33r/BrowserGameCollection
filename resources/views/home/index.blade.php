@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <p class="text-2xl font-medium py-2 px-4">Home - Featured Games</p>

            @if ($games->count())

                <div class="grid gap-4 grid-cols-3 pb-2">
                    @foreach($games as $game)

                        <div class="bg-gray-100 rounded-lg p-1 m-4">
                            <a href="{{route('game.show', $game->id)}}">
                                <div class="flex flex-col items-center">
                                    <p class="p-1">
                                        <span class="font-medium text-lg">{{$game->title}}</span>
                                        <span class="">von {{$game->developer}}</span>
                                    </p>

                                    <img src="{{$game->gameImage()}}" class="w-11/12 py-1">

                                    <p class="p-1">Bewertung</p>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>

                {{ $games->links() }}
            @else
                Keine Ergebnisse gefunden
            @endif
        </div>
    </div>
@endsection
