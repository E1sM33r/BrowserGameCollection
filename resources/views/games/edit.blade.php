@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            <div class="flex justify-between">
                <div class="text-2xl font-medium mb-4">
                    Spiel bearbeiten
                </div>

                <a href="{{ route('game.show', $game->id) }}">
                    <div class="bg-gray-200 rounded-lg p-1">
                        Abbrechen
                    </div>
                </a>
            </div>

            <form action="{{ route('game.update', $game->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="">Titel</label>
                    <input type="text" name="title" id="title" placeholder="Titel" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('title') border-red-500 @enderror" value="{{ old('title') ?? $game->title }}">

                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="developer" class="">Entwickler</label>
                    <input type="text" name="developer" id="developer" placeholder="Entwickler" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('developer') border-red-500 @enderror" value="{{ old('developer') ?? $game->developer }}">

                    @error('developer')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="mb-2">Beschreibung</label>
                    <textarea name="description" id="description" placeholder="Beschreibung..." maxlength="1200"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg h-80 resize-none
                @error('description') border-red-500 @enderror">{{ old('description') ?? $game->description }}</textarea>

                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <p class="font-medium">Tags</p>
                <div class="mb-4 flex items-center">
                    @foreach($tags as $tag)
                        <label for="{{$tag->name}}" class="px-3">{{$tag->name}}</label>
                        <input type="checkbox" name="tags[]" id="{{$tag->name}}" class="bg-gray-100 border-2 p-4 rounded-lg" value="{{$tag->name}}"
                               @foreach($game->tags as $gameTag)
                               @if($gameTag->name == $tag->name)
                               checked
                            @endif
                            @endforeach
                        >
                    @endforeach
                </div>


                <p class="font-medium">Demo/Echtes Game</p>
                <div class="mb-4 flex items-center">
                    @if($game->realGame)
                        <label for="demoGame" class="pr-2">Nur Demo</label>
                        <input type="radio" name="realGame" id="demoGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="false">
                        <label for="demoGame" class="px-4">Echtes Game</label>
                        <input type="radio" name="realGame" id="realGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="true" checked>
                    @else
                        <label for="demoGame" class="pr-2">Nur Demo</label>
                        <input type="radio" name="realGame" id="demoGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="false" checked>
                        <label for="demoGame" class="px-4">Echtes Game</label>
                        <input type="radio" name="realGame" id="realGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="true">
                    @endif
                </div>

                <div class="mb-4">
                    <label for="image" class="font-medium mb-2">Titelbild</label><br/>

                    <input type="file" class="mt-2" id="image" name="image">

                    @error('image')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Spiel bearbeiten</button>
                </div>
            </form>
        </div>
    </div>
@endsection
