@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="2xl:w-2/6 xl:w-3/6 lg:w-3/6 md:w-4/6 sm:w-10/12 bg-gray-200 p-6 rounded-lg">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email" class="bg-white border-2 w-full p-4 rounded-lg
                @error('email') border-red-500 @enderror">

                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Choose a password" class="bg-white border-2 w-full p-4 rounded-lg
                @error('password') border-red-500 @enderror" value="">

                    @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password again</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password"
                           class="bg-white border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">

                    @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <input type="hidden" name="token" id="token" value="{{$token}}">

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-600">Passwort zurücksetzen</button>
                </div>
            </form>
        </div>
    </div>
@endsection
