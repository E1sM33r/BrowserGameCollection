@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-gray-200 p-6 rounded-lg">

            <div class="flex justify-between">
                <div class="text-2xl font-medium mb-4">
                    Spiel bearbeiten
                </div>

                <a href="{{ route('game.show', $game->id) }}">
                    <div class="bg-blue-500 text-white rounded-lg p-1 hover:bg-blue-600">
                        Abbrechen
                    </div>
                </a>
            </div>

            <form action="{{ route('game.update', $game->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="">Titel</label>
                    <input type="text" name="title" id="title" placeholder="Titel" class="bg-white border-2 w-full p-4 rounded-lg
                @error('title') border-red-500 @enderror" value="{{ old('title') ?? $game->title }}">

                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="developer" class="">Entwickler</label>
                    <input type="text" name="developer" id="developer" placeholder="Entwickler" class="bg-white border-2 w-full p-4 rounded-lg
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
                              class="bg-white border-2 w-full p-4 rounded-lg h-80 resize-none
                @error('description') border-red-500 @enderror">{{ old('description') ?? $game->description }}</textarea>

                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="">
                    <p class="font-medium">Tags</p>

                    <p class="underline">Genre</p>
                    <div class="mb-2 flex items-center @error('tagsGenre') border-2 rounded-lg border-red-500 @enderror">
                        <label for="JumpnRun" class="pr-2">Jump&Run</label>
                        <input type="checkbox" name="tagsGenre[0]" id="JumpnRun" class="bg-gray-100 border-2 p-4 rounded-lg" value="Jump&Run" @if($game->tags->contains('name', 'Jump&Run')) checked @endif>
                        <label for="Arcade" class="px-4">Arcade</label>
                        <input type="checkbox" name="tagsGenre[1]" id="Arcade" class="bg-gray-100 border-2 p-4 rounded-lg" value="Arcade" @if($game->tags->contains('name', 'Arcade')) checked @endif>
                        <label for="Shooter" class="px-4">Shooter</label>
                        <input type="checkbox" name="tagsGenre[2]" id="Shooter" class="bg-gray-100 border-2 p-4 rounded-lg" value="Shooter" @if($game->tags->contains('name', 'Shooter')) checked @endif>
                    </div>
                    @error('tagsGenre')
                    <div class="text-red-500 text-sm mb-2">
                        {{ $message }}
                    </div>
                    @enderror

                    <p class="underline">Steuerung</p>
                    <div class="mb-2 flex items-center @error('tagsControl') border-2 rounded-lg border-red-500 @enderror">
                        <label for="Tastatur" class="pr-2">Tastatur</label>
                        <input type="checkbox" name="tagsControl[0]" id="Tastatur" class="bg-gray-100 border-2 p-4 rounded-lg" value="Tastatur" @if($game->tags->contains('name', 'Tastatur')) checked @endif>
                        <label for="Maus" class="px-2">Maus</label>
                        <input type="checkbox" name="tagsControl[1]" id="Maus" class="bg-gray-100 border-2 p-4 rounded-lg" value="Maus" @if($game->tags->contains('name', 'Maus')) checked @endif>
                    </div>
                    @error('tagsControl')
                    <div class="text-red-500 text-sm mb-2">
                        {{ $message }}
                    </div>
                    @enderror

                    <p class="underline">Highscore Typ</p>
                    <div class="mb-2 flex items-center @error('tagsType') border-2 rounded-lg border-red-500 @enderror">
                        <label for="Endlos" class="pr-2">Endlos</label>
                        <input type="radio" name="tagsType[]" id="Endlos" class="bg-gray-100 border-2 p-4 rounded-lg" value="Endlos" @if($game->tags->contains('name', 'Endlos')) checked @endif>
                        <label for="Zeitbegrenzt" class="px-2">Zeitbegrenzt</label>
                        <input type="radio" name="tagsType[]" id="Zeitbegrenzt" class="bg-gray-100 border-2 p-4 rounded-lg" value="Zeitbegrenzt" @if($game->tags->contains('name', 'Zeitbegrenzt')) checked @endif>
                    </div>

                    @error('tagsType')
                    <div class="text-red-500 text-sm mb-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <p class="font-medium">Demo/Echtes Game</p>
                <div class="mb-4 flex items-center">
                    @if($game->realGame == 'true')
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Spiel bearbeiten</button>
                </div>
            </form>
        </div>
    </div>
@endsection
