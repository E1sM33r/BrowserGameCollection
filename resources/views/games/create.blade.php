@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            <div class="text-2xl font-medium mb-4">
                Spiel hinzufügen
            </div>

            <form action="{{ route('game.store') }}" enctype="multipart/form-data" method="post">
                @csrf


                <div class="mb-4">
                    <label for="title" class="font-medium">Titel</label>
                    <input type="text" name="title" id="title" placeholder="Titel" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="developer" class="font-medium">Entwickler</label>
                    <input type="text" name="developer" id="developer" placeholder="Entwickler" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('developer') border-red-500 @enderror" value="{{ old('developer') }}">

                    @error('developer')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="mb-2 font-medium">Beschreibung</label>
                    <textarea name="description" id="description" placeholder="Beschreibung..." maxlength="1200"
                              class="bg-gray-100 border-2 w-full p-4 rounded-lg h-80 resize-none
                @error('description') border-red-500 @enderror">{{ old('description')}}</textarea>

                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="">
                <p class="font-medium">Tags</p>
                <div class="mb-2 flex items-center @error('tags') border-2 rounded-lg border-red-500 @enderror">
                    <label for="JumpnRun" class="pr-2">Jump&Run</label>
                    <input type="checkbox" name="tags[0]" id="JumpnRun" class="bg-gray-100 border-2 p-4 rounded-lg" value="Jump&Run">
                    <label for="Arcade" class="px-4">Arcade</label>
                    <input type="checkbox" name="tags[1]" id="Arcade" class="bg-gray-100 border-2 p-4 rounded-lg" value="Arcade">
                    <label for="Shooter" class="px-4">Shooter</label>
                    <input type="checkbox" name="tags[2]" id="Shooter" class="bg-gray-100 border-2 p-4 rounded-lg" value="Shooter">
                </div>
                @error('tags')
                <div class="text-red-500 text-sm mb-2">
                    {{ $message }}
                </div>
                @enderror
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Spiel hinzufügen</button>
                </div>
            </form>
        </div>
    </div>
@endsection
