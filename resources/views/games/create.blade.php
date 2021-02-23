@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">

            <div class="text-2xl font-medium mb-4">
                Spiel hinzufügen
            </div>

            <form action="{{ route('game.store') }}" enctype="multipart/form-data" method="post">
                @csrf


                <div class="mb-4">
                    <label for="title" class="font-medium">Titel</label>
                    <input type="text" name="title" id="title" placeholder="Titel" class="bg-white border-2 w-full p-4 rounded-lg
                @error('title') border-red-500 @enderror" value="{{ old('title') }}">

                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="developer" class="font-medium">Entwickler</label>
                    <input type="text" name="developer" id="developer" placeholder="Entwickler" class="bg-white border-2 w-full p-4 rounded-lg
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
                              class="bg-white border-2 w-full p-4 rounded-lg h-80 resize-none
                @error('description') border-red-500 @enderror">{{ old('description')}}</textarea>

                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="">
                    <p class="font-medium">Tags</p>

                    <p class="underline">Genre</p>
                    <div class="mb-2 flex items-center flex-wrap @error('tagsGenre') border-2 rounded-lg border-red-500 @enderror">
                        <label for="JumpnRun" class="pr-2">Jump&Run</label>
                        <input type="checkbox" name="tagsGenre[0]" id="JumpnRun" value="Jump&Run">
                        <label for="Arcade" class="px-2">Arcade</label>
                        <input type="checkbox" name="tagsGenre[1]" id="Arcade" value="Arcade">
                        <label for="Shooter" class="px-2">Shooter</label>
                        <input type="checkbox" name="tagsGenre[2]" id="Shooter" value="Shooter">
                        <label for="Racing" class="px-2">Racing</label>
                        <input type="checkbox" name="tagsGenre[3]" id="Racing" value="Racing">
                        <label for="Abenteur" class="px-2">Abenteur</label>
                        <input type="checkbox" name="tagsGenre[4]" id="Abenteur" value="Abenteur">
                        <label for="Geschick" class="px-2">Geschick</label>
                        <input type="checkbox" name="tagsGenre[5]" id="Geschick" value="Geschick">
                    </div>
                    @error('tagsGenre')
                    <div class="text-red-500 text-sm mb-2">
                        {{ $message }}
                    </div>
                    @enderror

                    <p class="underline">Steuerung</p>
                    <div class="mb-2 flex items-center @error('tagsControl') border-2 rounded-lg border-red-500 @enderror">
                        <label for="Tastatur" class="pr-2">Tastatur</label>
                        <input type="radio" name="tagsControl[]" id="Tastatur" class="bg-gray-100 border-2 p-4 rounded-lg" value="Tastatur">
                        <label for="Maus" class="px-2">Maus</label>
                        <input type="radio" name="tagsControl[]" id="Maus" class="bg-gray-100 border-2 p-4 rounded-lg" value="Maus">
                        <label for="Maus&Tastatur" class="px-2">Maus&Tastatur</label>
                        <input type="radio" name="tagsControl[]" id="Maus&Tastatur" class="bg-gray-100 border-2 p-4 rounded-lg" value="Maus&Tastatur">
                    </div>
                    @error('tagsControl')
                    <div class="text-red-500 text-sm mb-2">
                        {{ $message }}
                    </div>
                    @enderror

                    <p class="underline">Highscore Typ</p>
                    <div class="mb-2 flex items-center @error('tagsType') border-2 rounded-lg border-red-500 @enderror">
                        <label for="Endlos" class="pr-2">Endlos</label>
                        <input type="radio" name="tagsType[]" id="Endlos" class="bg-gray-100 border-2 p-4 rounded-lg" value="Endlos">
                        <label for="Zeitbegrenzt" class="px-2">Zeitbegrenzt</label>
                        <input type="radio" name="tagsType[]" id="Zeitbegrenzt" class="bg-gray-100 border-2 p-4 rounded-lg" value="Zeitbegrenzt">
                    </div>

                    @error('tagsType')
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Spiel hinzufügen</button>
                </div>
            </form>
        </div>
    </div>
@endsection
