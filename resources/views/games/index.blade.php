@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-8/12 xl:w-8/12 md:w-11/12 sm:w-11/12 bg-gray-200 p-6 rounded-lg">
            <div class="flex justify-between">
                <p class="text-2xl font-medium py-2 px-4">Suchergebnisse</p>
                <form action="{{ route('results') }}" method="get">
                    <label for="orderBy">Sortieren nach: </label>
                    <select name="order" id="orderBy" class="bg-gray-400 rounded hover:bg-gray-500 hover:text-white" onchange="this.form.submit()">
                        <option value="title" id="title">Name</option>
                        <option value="averageRating" id="average">Bewertung</option>
                        <option value="likes" id="likes">Likes</option>
                        <option value="ratings" id="total">Anzahl Bewertungen</option>
                    </select>
                    <input type="hidden" name="search" value="{{ $search }}">
                    @if($tagsGenre != 0)
                        @foreach($tagsGenre as $tag)
                            <input type="hidden" name="tagsGenre[]" value="{{ $tag }}">
                        @endforeach
                    @endif
                    @if($tagsControl != 0)
                        @foreach($tagsControl as $tag)
                            <input type="hidden" name="tagsControl[]" value="{{ $tag }}">
                        @endforeach
                    @endif
                    @if($tagsType != 0)
                        @foreach($tagsType as $tag)
                            <input type="hidden" name="tagsType[]" value="{{ $tag }}">
                        @endforeach
                    @endif
                </form>
            </div>


            @if ($games->count())

                <div class="grid 2xl:gap-4 2xl:grid-cols-3 xl:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 pb-2 overflow-hidden" id="app">
                    @foreach($games as $game)

                        <div class="bg-gray-400 rounded-lg p-1 m-4 hover:bg-gray-500 hover:text-white min-w-min">
                            <a href="{{route('game.show', $game->id)}}">
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex justify-end text-sm my-1">
                                        @foreach($game->tags as $tag)
                                            @if($tag->name == 'Jump&Run' || $tag->name == 'Arcade' || $tag->name == 'Shooter')
                                                <span class="px-0.5 mx-1 mt-1 bg-red-500 rounded text-white">{{ $tag->name }}</span>
                                            @elseif($tag->name == 'Tastatur' || $tag->name == 'Maus')
                                                <span class="px-0.5 mx-1 mt-1 bg-green-500 rounded text-white">{{ $tag->name }}</span>
                                            @elseif($tag->name == 'Endlos' || $tag->name == 'Zeitbegrenzt')
                                                <span class="px-0.5 mx-1 mt-1 bg-yellow-500 rounded text-white">{{ $tag->name }}</span>
                                            @endif
                                        @endforeach
                                    </div>
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
