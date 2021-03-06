@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">
            <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="name" class="">Name:</label>
                <input type="text" name="name" id="name" placeholder="Name" maxlength="60" class="bg-white border-2 w-full p-4 rounded-lg
                @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="username" class="">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" maxlength="60" class="bg-white border-2 w-full p-4 rounded-lg
                @error('username') border-red-500 @enderror" value="{{ old('username') }}">

                @error('username')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="">E-Mail Adresse:</label>
                <input type="text" name="email" id="email" placeholder="E-Mail Adresse" maxlength="150" class="bg-white border-2 w-full p-4 rounded-lg
                @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="">Passwort:</label>
                <input type="password" name="password" id="password" placeholder="Passwort" maxlength="60" class="bg-white border-2 w-full p-4 rounded-lg
                @error('password') border-red-500 @enderror" value="">

                @error('password')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="">Passwort bestätigen:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Passwort bestätigen" maxlength="60"
                       class="bg-white border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">

                @error('password_confirmation')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Registrieren</button>
            </div>
            </form>
        </div>
    </div>
@endsection
