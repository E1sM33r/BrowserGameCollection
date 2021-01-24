@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-200 p-6 rounded-lg">

            @if (session('status'))
                <div class="bg-blue-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <div class="p-3 flex justify-between align-middle">
                <div class="text-3xl">
                    Profil von {{ $user->username }}
                </div>

                @can('update', $user->profile)
                    <div>
                        <a href="/account/{{$user->id}}/edit">
                            <div class="bg-blue-500 rounded-lg p-1 m-1 hover:bg-blue-600 text-white">
                                Account bearbeiten
                            </div>
                        </a>
                        <a href="/profile/{{$user->id}}/edit">
                            <div class="bg-blue-500 rounded-lg p-1 m-1 text-center hover:bg-blue-600 text-white">
                                Profil bearbeiten
                            </div>
                        </a>
                    </div>
                @endcan
            </div>

            <div class="flex justify-between p-3">

                <div class="w-1/4 bg-gray-200 p-3">
                    @if($user->profile->image == 'default')
                        <img src="{{asset('images/defaultImages/ProfileDefault.png')}}" class="shadow rounded-full max-w-full h-auto align-middle border-none">
                    @else
                    <img src="/storage/{{ $user->profile->image }}" class="shadow rounded-full max-w-full h-auto align-middle border-none">
                    @endif
                </div>
                <div class="w-3/4 bg-gray-50 shadow rounded-lg p-3 flex flex-col justify-between">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <div class="text-lg px-3">
                                <span class="font-medium">Name: </span>{{ $user->name }} <br/>
                            </div>
                            <div class="py-5">
                                <div class="font-bold text-2xl p-3">
                                    Beschreibung
                                </div>
                                <div class="px-3">
                                    {!! nl2br(e($user->profile->description)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center w-1/2">
                            <p class="pb-2 font-medium text-lg">Highscores</p>
                            @if($user->highscores->count()>0)
                                <table class="w-3/4">
                                    <tr>
                                        <th class="border border-black">Spiel</th>
                                        <th class="border border-black">Score</th>
                                        <th class="border border-black">Rang</th>
                                    </tr>

                                    @for($i = 0; $i<$user->highscores->count(); $i++)
                                        <tr>
                                            <td class="text-center border border-black"><a href="{{ route('game.show', $user->highscores[$i]->game->id) }}">{{ $user->highscores[$i]->game->title }}</a></td>
                                            <td class="text-center border border-black">{{ $user->highscores[$i]->score }}</td>
                                            <td class="text-center border border-black">{{ $user->getHighscoreRank($user->highscores[$i]->game) }}</td>
                                        </tr>
                                    @endfor

                                </table>
                            @else
                                Keine Highscores vorhanden
                            @endif
                        </div>
                    </div>
                    <div class="px-4">
                        Mitglied seit {{ $user->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
