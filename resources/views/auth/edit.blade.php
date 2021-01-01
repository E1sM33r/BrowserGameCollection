@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">

            <div class="flex justify-between">
                <div class="text-2xl font-medium mb-4">
                    Accountdaten bearbeiten
                </div>

                <a href="{{ route('profiles.show', $user->username) }}">
                    <div class="bg-gray-200 rounded-lg p-1">
                        Abbrechen
                    </div>
                </a>
            </div>

            <form action="{{ route('register.update', $user->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="name" class="">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('name') border-red-500 @enderror" value="{{ old('name') ?? $user->name }}">

                    @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('username') border-red-500 @enderror" value="{{ old('username') ?? $user->username }}">

                    @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="">Email:</label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="bg-gray-100 border-2 w-full p-4 rounded-lg
                @error('email') border-red-500 @enderror" value="{{ old('email') ?? $user->email }}">

                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Änderungen speichern</button>
                </div>
            </form>
            <div class="flex justify-center">
            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded font-medium w-1/2 mt-2"><a href="/account/{{$user->id}}/changepw">Passwort ändern</a></button>
            </div>
        </div>
    </div>
@endsection
