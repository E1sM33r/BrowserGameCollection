@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">

            <div class="flex justify-between pt-4">

                <div class="w-2/12 bg-gray-200 rounded-lg mt-6">
                    <p class="font-medium text-2xl text-center py-4">Games</p>
                    <div class="flex flex-col text-center items-center">
                        @foreach($games as $game)
                            <a href="{{ route('highscores.game', $game) }}" class="m-2 py-0.5 bg-blue-500 rounded-lg w-3/4">{{ $game->title }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="w-10/12">
                    <p class="font-medium text-3xl text-center py-4">Highscores @if($selected->id > 0) - <a href="{{ route('game.show', $selected) }}">{{ $selected->title }}</a> @endif</p>
                    <div>

                        @if($selected->id > 0)
                            <div class="flex flex-col items-center pt-4">
                                @if($highscores->count() > 0)
                                    <table class="w-3/4 table-fixed border-collapse">
                                        <tr>
                                            <th class="w-1/6 bg-gray-100 border border-black">Position</th>
                                            <th class="w-1/2 bg-gray-200 border border-black">Nickname</th>
                                            <th class="w-1/6 bg-gray-100 border border-black">Score</th>
                                            <th class="w-2/6 bg-gray-200 border border-black">Wann</th>
                                        </tr>
                                        @foreach($highscores as $highscore)
                                            <tr>
                                                <td class="bg-gray-100 text-center border border-black">{{ $highscore->rank }}</td>
                                                <td class="bg-gray-200 text-center border border-black"><a href="{{ route('profiles.show', $highscore->user->username) }}">{{ $highscore->user->username }}</a></td>
                                                <td class="bg-gray-100 text-center border border-black">{{ $highscore->score }}</td>
                                                <td class="bg-gray-200 text-center border border-black">{{ $highscore->updated_at->format('d.m.Y - H:i') }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <p class="text-center py-4 text-xl">Keine Highscores vorhanden</p>
                                        @endif
                                    </table>
                            </div>
                            <div class="py-4 w-3/4 mx-auto">
                                {{ $highscores->links() }}
                            </div>
                        @else
                            <p class="text-center py-4 text-xl">Kein Spiel ausgewählt</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
