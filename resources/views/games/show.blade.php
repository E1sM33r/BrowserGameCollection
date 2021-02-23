@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 min-w-min bg-gray-200 p-6 rounded-lg">

            <div class="py-2 flex justify-between">
                <div>
                    <span class="font-medium text-4xl">{{ $game->title }}</span><br/>
                    <span>von {{ $game->developer }}</span>
                </div>
                <div class="p-4">
                        @foreach($game->tags as $tag)
                            @if($tag->type == 'genre')
                                <span class="py-1 px-2 mx-1 bg-red-500 rounded text-white">{{ $tag->name }}</span>
                            @endif
                        @endforeach
                        @foreach($game->tags as $tag)
                            @if($tag->type == 'control')
                                <span class="py-1 px-2 mx-1 bg-green-500 rounded text-white">{{ $tag->name }}</span>
                            @endif
                        @endforeach
                        @foreach($game->tags as $tag)
                            @if($tag->type == 'type')
                                <span class="py-1 px-2 mx-1 bg-yellow-500 rounded text-white">{{ $tag->name }}</span>
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
                            <p class="px-2">({{ $game->likes->count() }})</p>
                            @if(!$game->hasLiked(auth()->user()))
                                <form action="{{ route('game.like', $game) }}" method="post" class="flex items-center">
                                    @CSRF
                                    <button type="submit" class="text-gray-500 text-4xl hover:text-red-500">&hearts;</button>
                                    <span class="ml-1">merken</span>
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
                                <p class="px-1">{{$game->likes->count()}}</p>
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
                    <table class="2xl:w-1/2 md:w-3/4 table-fixed border-collapse">
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
                    <a href="{{ route('highscores.game', $game->id) }}" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded font-medium w-auto hover:bg-blue-600">Alle Highscores anzeigen</a>

                </div>
            </div>

            <hr class="border-gray-500">

            <div class="py-2">
                <span class="font-medium text-xl">Kommentare</span>

                @auth()
                    <form action="{{ route('game.comment', $game) }}" method="post" class="mt-2 mb-4">
                        @CSRF
                        <textarea name="comment" id="comment" placeholder="Kommentar schreiben..." maxlength="800"
                                  class="bg-white border-2 w-full p-4 rounded-lg resize-none @error('comment') border-red-500 @enderror"></textarea>

                        @error('comment')
                        <div class="text-red-500 my-1 text-sm">
                            {{ $message }}
                        </div>
                        @enderror

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium w-auto hover:bg-blue-600">Kommentieren</button>
                    </form>
                @endauth

                <div class="my-2 rounded">
                    <div class="my-2 bg-white rounded">
                        @if($game->comments->count() > 0)
                            @foreach($comments as $comment)
                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center">
                                        <div>
                                            @if($comment->user->profile->image == 'default')
                                                <a href="{{ route('profiles.show', $comment->user->username) }}" class="w-16 min-w-min"><img src="{{asset('images/defaultImages/ProfileDefault.png')}}" class="w-16 h-auto m-2 shadow rounded-full align-middle border-none"></a>
                                            @else
                                                <a href="{{ route('profiles.show', $comment->user->username) }}" class="w-16 min-w-min"><img src="/storage/{{ $comment->user->profile->image }}" class="w-16 h-auto m-2 shadow rounded-full align-middle border-none"></a>
                                            @endif
                                        </div>
                                        <div class="pl-2 pr-4">
                                            <div>
                                                <a href="{{ route('profiles.show', $comment->user->username) }}" class="font-medium hover:text-gray-600">{{ $comment->user->username }}</a>
                                                <span class="text-sm italic">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm 2xl:max-w-6xl xl:max-w-3xl lg:max-w-2xl md:max-w-2xl sm:max-w-2xl break-words">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>
                                    </div>
                                    <div>
                                        @auth()
                                            @if($comment->ownedBy(auth()->user()))
                                                <form action="{{ route('comment.delete', $comment) }}" method="post" class="min-w-min px-2">
                                                    @CSRF
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 text-sm rounded font-medium w-auto hover:bg-red-600">Löschen</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <hr class="border-gray-400 mt-2">
                            @endforeach
                        @else
                            <div class="flex justify-center font-medium">
                                <p>Keine Kommentare vorhanden!</p>
                            </div>
                        @endif
                    </div>
                    {{ $comments->links() }}
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

