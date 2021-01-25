@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-200 p-6 rounded-lg">

            <div class="py-2 flex justify-between">
                <div>
                    <span class="font-medium text-4xl">{{ $game->title }}</span><br/>
                    <span>von {{ $game->developer }}</span>
                </div>
                <div class="p-4">
                    @foreach($game->tags as $tag)
                        @if($tag->name == 'Jump&Run' || $tag->name == 'Arcade' || $tag->name == 'Shooter')
                            <span class="p-1 bg-red-500 rounded">{{ $tag->name }}</span>
                        @elseif($tag->name == 'Tastatur' || $tag->name == 'Maus')
                            <span class="p-1 bg-green-500 rounded">{{ $tag->name }}</span>
                        @elseif($tag->name == 'Endlos' || $tag->name == 'Zeitbegrenzt')
                            <span class="p-1 bg-yellow-500 rounded">{{ $tag->name }}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center py-2">
                <div class="bg-gray-100 rounded-lg w-3/4 flex justify-center" id="game-window">
                    @if($game->realGame == 'false')
                        <img src="{{ $game->gameImage() }}" alt="Game Screenshot">
                    @endif


                </div>
            </div>
            <div class="flex justify-center pb-2">
                <div class="bg-gray- w-3/4 flex justify-between">

                    <div class="flex items-center">

                        @auth()
                            <div id="app">
                                <star-rating @rating-selected ="setRating" :rating="{{ $game->userAverageRating ?? 0 }}" :show-rating="false" :star-size="30"></star-rating>
                                <form action="{{ route('game.rate', $game) }}" method="post" id="ratingForm">
                                    @CSRF
                                    <input type="hidden" name="rating" id="rating" value="1">
                                </form>
                            </div>
                            <p class="px-2">&empty; {{round($game->averageRating(), 2)}}</p>
                            <p>({{$game->usersRated()}} Bewertungen)</p>
                        @endauth
                        @guest()
                            <div id="app" class="flex items-center">
                                <star-rating :rating="{{ round($game->averageRating(), 2) }}" :read-only="true" :increment="0.01" :star-size="30"></star-rating>
                                <p class="px-2">({{$game->usersRated()}} Bewertungen)</p>
                            </div>
                        @endguest

                    </div>

                    <div class="flex items-center">
                        @auth()
                            <p class="px-2">({{ $game->likes->count() }} {{ Str::plural ('Like', $game->likes->count()) }})</p>
                            @if(!$game->hasLiked(auth()->user()))
                                <form action="{{ route('game.like', $game) }}" method="post">
                                    @CSRF
                                    <button type="submit" class="text-gray-500 text-4xl hover:text-red-500">&hearts;</button>
                                </form>
                            @else
                                <form action="{{ route('game.like', $game) }}" method="post">
                                    @CSRF
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-4xl hover:text-gray-500">&hearts;</button>
                                </form>
                            @endif
                        @endauth
                        @guest()
                            <div class="flex items-center">
                                <p class="px-1">2</p>
                                <span class="text-red-500 text-4xl">&hearts;</span>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>

            <hr class="border-gray-500">

            <div class="py-2">
                <span class="font-medium text-xl" id="test">Beschreibung</span>
                <div>
                    {!! nl2br(e($game->description)) !!}
                </div>
            </div>

            <hr class="border-gray-500">

            <div class="py-2">
                <span class="font-medium text-xl">Highscores</span>
                <div class="flex flex-col items-center">
                    <table class="w-1/2 table-fixed border-collapse">
                        <tr>
                            <th class="w-1/6 bg-white border border-black">Position</th>
                            <th class="w-1/2 bg-gray-50 border border-black">Nickname</th>
                            <th class="w-1/6 bg-white border border-black">Score</th>
                            <th class="w-2/6 bg-gray-50 border border-black">Wann</th>
                        </tr>
                        @if($highscores->count()==0)
                            <tr>
                                <td colspan="4" class="text-center bg-white border border-black">Keine Highscores vorhanden</td>
                            </tr>
                        @else
                            @for($i = 0; $i<$highscores->count(); $i++)
                                <tr>
                                    <td class="bg-white text-center border border-black">{{ $highscores[$i]->rank }}</td>
                                    <td class="bg-gray-50 text-center border border-black"><a href="{{ route('profiles.show', $highscores[$i]->user->username) }}" class="hover:text-gray-400">{{ $highscores[$i]->user->username }}</a></td>
                                    <td class="bg-white text-center border border-black">{{ $highscores[$i]->score }}</td>
                                    <td class="bg-gray-50 text-center border border-black">{{ $highscores[$i]->updated_at->format('d.m.Y - H:i') }}</td>
                                </tr>
                            @endfor
                        @endif

                    </table>
                    <a href="{{ route('highscores.game', $game->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white p-1 m-4 rounded">Alle Highscores anzeigen</a>

                </div>
            </div>

        </div>
    </div>

    @auth()
        <input type="hidden" name="oldHighscore" id="oldHighscore" value="{{ auth()->user()->hasHighscore($game) }}">
        <form action="{{ route('game.addHighscore', $game->id) }}" method="post" id="highscoreForm">
            @csrf
            <input type="hidden" name="highscore" id="highscore" value="">
        </form>
    @endauth

    <script src="{{ mix('js/app.js') }}"></script>
@endsection

@push('scripts')
    <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameScene.js"></script>
    <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameOverScene.js"></script>
    <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/titleScene.js"></script>
    <script src="{{ asset('js/games')}}/{{ $game->title }}/game.js"></script>
@endpush

