@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">

            <div class="flex justify-between">
                <div class="text-2xl font-medium mb-4">
                    Passwort ändern
                </div>

                <a href="/account/{{$user->id}}/edit">
                    <div class="bg-blue-500 rounded-lg px-4 py-2 text-white hover:bg-blue-600">
                        Abbrechen
                    </div>
                </a>
            </div>

            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('user.updatePW', $user->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="oldPassword" class="sr-only">Aktuelles Passwort:</label>
                    <input type="password" name="oldPassword" id="oldPassword" placeholder="Aktuelles Passwort" class="bg-white border-2 w-full p-4 rounded-lg
                @error('oldPassword') border-red-500 @enderror" value="">

                    @error('oldPassword')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Neues Passwort:</label>
                    <input type="password" name="password" id="password" placeholder="Neues Passwort" class="bg-white border-2 w-full p-4 rounded-lg
                @error('password') border-red-500 @enderror" value="">

                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password bestätigen:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Neues Passwort bestätigen"
                           class="bg-white border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">

                    @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Passwort ändern</button>
                </div>
            </form>
        </div>
    </div>
@endsection
