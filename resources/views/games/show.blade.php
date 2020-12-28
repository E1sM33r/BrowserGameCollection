@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <div class="py-2">
                <span class="font-medium text-4xl">{{ $game->title }}</span><br/>
                <span>von {{ $game->developer }}</span>
            </div>

            <div class="flex justify-center py-2">
                <div class="bg-gray-100 rounded-lg w-3/4 h-80">
                </div>
            </div>
            <div class="flex justify-center pb-2">
                <div class="bg-gray- w-3/4 flex justify-between">
                    <span class="pl-2">Bewertung</span>
                    <span class="pr-2">Like</span>
                </div>
            </div>

            <hr>

            <div class="py-2">
                <span class="font-medium text-xl">Beschreibung</span>
                <div>
                    {{ $game->description }}
                </div>
            </div>

            <hr>

            <div class="py-2">
                <span class="font-medium text-xl">Highscores</span>
                <div>
                    Highscores
                </div>
            </div>

        </div>
    </div>
@endsection
