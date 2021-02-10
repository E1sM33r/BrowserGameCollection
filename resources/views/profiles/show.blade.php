@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-8/12 xl:w-8/12 md:w-11/12 sm:w-11/12 bg-gray-200 p-6 rounded-lg">

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
                            <div class="bg-blue-500 rounded-lg px-5 py-2 m-1 hover:bg-blue-600 text-white">
                                Account bearbeiten
                            </div>
                        </a>
                        <a href="/profile/{{$user->id}}/edit">
                            <div class="bg-blue-500 rounded-lg px-5 py-2 m-1 text-center hover:bg-blue-600 text-white">
                                Profil bearbeiten
                            </div>
                        </a>
                    </div>
                @endcan
            </div>

            <div class="flex flex-col justify-between p-3">

                <div class="min-w-min bg-gray-50 shadow rounded-lg p-3 flex flex-col justify-between">
                    <div class="flex justify-between flex-nowrap">
                        <div class="w-1/2">
                            <div class="text-lg px-3">
                                @if($user->profile->image == 'default')
                                    <img src="{{asset('images/defaultImages/ProfileDefault.png')}}" class="shadow rounded-full w-1/3 h-auto align-middle border-none">
                                @else
                                    <img src="/storage/{{ $user->profile->image }}" class="shadow rounded-full w-1/3 h-auto align-middle border-none">
                                @endif
                                <div class="py-2">
                                    <span class="font-medium pl-2 pr-1">Name: </span><span>{{ $user->name }}</span> <br/>
                                </div>
                            </div>
                            <div class="py-5 px-1">
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
                                            <td class="text-center border border-black"><a href="{{ route('game.show', $user->highscores[$i]->game->id) }}" class="hover:text-gray-500">{{ $user->highscores[$i]->game->title }}</a></td>
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

                <div class="my-2 rounded">
                    <div class="my-2 bg-white rounded">
                        <span class="font-bold text-2xl px-7 py-2">Kommentare von {{ $user->username }}</span>
                        @if($user->comments->count() > 0)
                            @foreach($comments as $comment)
                                <hr class="border-gray-400 mt-2">
                                <div class="flex items-center justify-between my-2 px-7 py-2">
                                    <div class="flex items-center">
                                        <div class="pr-4">
                                            <div>
                                                <span class="font-medium">{{ $comment->user->username }} - </span>
                                                <span>in <a href="{{ route('game.show', $comment->game) }}" class="hover:text-gray-600">{{ $comment->game->title }}</a></span>
                                                <span class="text-sm italic">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm 2xl:max-w-6xl xl:max-w-3xl lg:max-w-2xl md:max-w-2xl sm:max-w-2xl break-words">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="px-7">
                                <p class="py-4">{{ $user->username }} hat bislang keine Kommentare geschrieben.</p>
                            </div>
                        @endif
                    </div>
                    {{ $comments->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
