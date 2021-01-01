@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <div class="py-2">
                <span class="font-medium text-4xl">{{ $game->title }}</span><br/>
                <span>von {{ $game->developer }}</span>
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
                    <span class="pl-2">Bewertung</span>
                    <span class="pr-2">Like</span>
                </div>
            </div>

            <hr>

            <div class="py-2">
                <span class="font-medium text-xl" id="test">Beschreibung</span>
                <div>
                    {{ $game->description }}
                </div>
            </div>

            <hr>
            <div class="py-2">
                <span class="font-medium text-xl">Highscores</span>
                <div class="flex flex-col items-center">
                    <table class="w-1/2 table-fixed border-collapse">
                        <tr>
                            <th class="w-1/6 bg-gray-100 border border-black">Position</th>
                            <th class="w-1/2 bg-gray-200 border border-black">Nickname</th>
                            <th class="w-1/6 bg-gray-100 border border-black">Score</th>
                            <th class="w-2/6 bg-gray-200 border border-black">Wann</th>
                        </tr>
                        @if($highscores->count()==0)
                            <tr>
                                <td colspan="4" class="text-center bg-gray-100 border border-black">Keine Highscores vorhanden</td>
                            </tr>
                        @else
                            @for($i = 0; $i<$highscores->count(); $i++)
                                <tr>
                                    <td class="bg-gray-100 text-center border border-black">{{ $i+1 }}</td>
                                    <td class="bg-gray-200 text-center border border-black">{{ $highscores[$i]->user->username }}</td>
                                    <td class="bg-gray-100 text-center border border-black">{{ $highscores[$i]->score }}</td>
                                    <td class="bg-gray-200 text-center border border-black">{{ $highscores[$i]->updated_at->format('d.m.Y - H:i') }}</td>
                                </tr>
                            @endfor
                        @endif

                    </table>

                </div>
            </div>

        </div>
    </div>

@endsection

@auth()
    @push('scripts')

        <input type="hidden" name="oldHighscore" id="oldHighscore" value="{{ auth()->user()->hasHighscore($game) }}">
        <form action="{{ route('game.addHighscore', $game->id) }}" method="post" id="highscoreForm">
            @csrf
            <input type="hidden" name="highscore" id="highscore" value="">
        </form>

        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameOverScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/titleScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/game.js"></script>
    @endpush
@endauth

@guest()
    @push('scripts')

        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/gameOverScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/scenes/titleScene.js"></script>
        <script src="{{ asset('js/games')}}/{{ $game->title }}/game.js"></script>
    @endpush
@endguest
