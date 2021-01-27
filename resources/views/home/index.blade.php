@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-8/12 xl:w-8/12 md:w-11/12 sm:w-11/12 bg-gray-200 p-6 rounded-lg">

            @if (session('status'))
                <div class="bg-blue-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-2xl font-medium py-2 px-4">Home - Featured Games</p>

            @if ($games->count())

                <div class="grid 2xl:gap-4 2xl:grid-cols-3 xl:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 pb-2 overflow-hidden" id="app">
                    @foreach($games as $game)

                        <div class="bg-gray-400 rounded-lg p-1 m-4 hover:bg-gray-500 hover:text-white min-w-min">
                            <a href="{{route('game.show', $game->id)}}">
                                <div class="flex flex-col items-center">
                                    <div class="w-full flex justify-end text-sm">
                                        @foreach($game->tags as $tag)
                                            @if($tag->type == 'genre')
                                                <span class="px-0.5 mx-1 mt-1 bg-red-500 rounded text-white">{{ $tag->name }}</span>
                                            @elseif($tag->type == 'control')
                                                <span class="px-0.5 mx-1 mt-1 bg-green-500 rounded text-white">{{ $tag->name }}</span>
                                            @elseif($tag->type == 'type')
                                                <span class="px-0.5 mx-1 mt-1 bg-yellow-500 rounded text-white">{{ $tag->name }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="px-1 flex flex-nowrap items-center whitespace-nowrap">
                                        <p class="font-medium text-lg px-2">{{$game->title}}</p>
                                        <p class="">von {{$game->developer}}</p>
                                    </div>
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
                <p class="p-4">Keine Ergebnisse gefunden</p>
            @endif
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
