@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="E-Mail Adresse" class="bg-white border-2 w-full p-4 rounded-lg
                @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Passwort" class="bg-white border-2 w-full p-4 rounded-lg
                @error('password') border-red-500 @enderror" value="">

                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember">Merken</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Login</button>
                </div>
            </form>
            <div class="flex justify-between pt-3">
                <div class="font-medium">
                    <a href="{{ route('register') }}" class="">Noch keinen Account?</a>
                </div>
                <div class="font-medium">
                    <a href="{{ route('password.request') }}" class="">Passwort vergessen?</a>
                </div>
            </div>

        </div>
    </div>
@endsection
