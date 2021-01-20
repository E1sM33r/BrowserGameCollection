@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="flex justify-between">
                <p class="text-2xl font-medium py-2 px-4">Suchergebnisse</p>
                <form action="{{ route('results') }}" method="get">
                    <label for="orderBy">Sortieren nach: </label>
                    <select name="order" id="orderBy" class="bg-gray-200 rounded" onchange="this.form.submit()">
                        <option value="title" id="title">Name</option>
                        <option value="averageRating" id="average">Bewertung</option>
                        <option value="likes" id="likes">Likes</option>
                        <option value="ratings" id="total">Anzahl Bewertungen</option>
                    </select>
                    <input type="hidden" name="search" value="{{ $search }}">
                    @if($tags != 0)
                    @foreach($tags as $tag)
                        <input type="hidden" name="tags[]" value="{{ $tag }}">
                    @endforeach
                    @endif
                </form>
            </div>


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

                                    <div class="flex justify-between w-11/12">
                                        <div class="flex items-center">
                                            <star-rating :rating="{{ round($game->averageRating(), 2) }}" :read-only="true" :increment="0.01" :star-size="30"></star-rating>
                                            <p class="p-2">({{$game->usersRated()}})</p>
                                        </div>
                                        <div class="p-2 flex items-center">
                                            <p class="px-2">{{ $game->likes->count() }} </p>
                                            <span class="text-red-500 text-4xl">&hearts;</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>

                {{ $games->links() }}
            @else
                <p class="px-4">Keine Ergebnisse gefunden</p>
            @endif
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script> document.getElementById('{{ $selected }}').selected = 'selected' </script>
@endsection
