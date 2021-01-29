@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">

            <div class="flex justify-between">
            <div class="text-2xl font-medium mb-4">
                Profil bearbeiten
            </div>

            <a href="{{ route('profiles.show', $user->username) }}">
                <div class="bg-blue-500 rounded-lg px-4 py-2 hover:bg-blue-600 text-white">
                    Abbrechen
                </div>
            </a>
            </div>
            <form action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="description" class="mb-2">Beschreibung</label>
                    <textarea name="description" id="description" placeholder="Beschreibung..." maxlength="1200"
                              class="bg-white border-2 w-full p-4 rounded-lg h-80 resize-none
                @error('description') border-red-500 @enderror">{{ old('description') ?? $user->profile->description }}</textarea>

                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="font-medium mb-2">Profilbild</label><br/>

                    <input type="file" class="mt-2" id="image" name="image">

                    @error('image')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Profil speichern</button>
                </div>
            </form>
        </div>
    </div>
@endsection
