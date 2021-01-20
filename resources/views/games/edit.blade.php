@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            <div class="text-2xl font-medium mb-4">
                Spiel bearbeiten
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
                    <label for="JumpnRun" class="pr-2">Jump&Run</label>
                    <input type="checkbox" name="tags[0]" id="JumpnRun" class="bg-gray-100 border-2 p-4 rounded-lg" value="Jump&Run">
                    <label for="Arcade" class="px-4">Arcade</label>
                    <input type="checkbox" name="tags[1]" id="Arcade" class="bg-gray-100 border-2 p-4 rounded-lg" value="Arcade">
                    <label for="Shooter" class="px-4">Shooter</label>
                    <input type="checkbox" name="tags[2]" id="Shooter" class="bg-gray-100 border-2 p-4 rounded-lg" value="Shooter">
                </div>

                <p class="font-medium">Demo/Echtes Game</p>
                <div class="mb-4 flex items-center">
                    <label for="demoGame" class="pr-2">Nur Demo</label>
                    <input type="radio" name="realGame" id="demoGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="false" checked>
                    <label for="demoGame" class="px-4">Echtes Game</label>
                    <input type="radio" name="realGame" id="realGame" class="bg-gray-100 border-2 p-4 rounded-lg" value="true">

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
