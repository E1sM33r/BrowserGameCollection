@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" x-data="{showDeleteModal:false}" x-bind:class="{ 'model-open': showDeleteModal }">

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

            <form action="{{ route('user.update', $user->id) }}" method="post" id="updateUser">
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

            </form>
            <div class="flex justify-between">
                <button type="submit" form="updateUser" class="bg-blue-500 text-white px-4 py-2 mx-1 rounded font-medium w-1/2">Änderungen speichern</button>
                <button type="button" class="bg-blue-500 text-white px-4 py-2 mx-1 rounded font-medium w-1/2"><a href="/account/{{$user->id}}/changepw">Passwort ändern</a></button>
            </div>
            <div class="flex justify-center">
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded font-medium w-1/2 mt-2" @click={showDeleteModal=true}>Account löschen</button>
            </div>

            <form action="{{route('user.delete', $user)}}" method="post" id="deleteUser">
                @csrf
                @method('DELETE')

            </form>

            <!-- Account delete confirmation modal -->
            <div x-show="showDeleteModal" tabindex="0"
                 class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                <div @click.away="showDeleteModal = false" class="z-50 relative p-3 mx-auto my-0 max-w-full"
                     style="width: 500px;">
                    <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden px-10 py-10">
                        <div class="text-center py-6 text-3xl text-gray-700 font-medium">Sind Sie sicher?</div>
                        <div class="text-center text-lg font-light text-gray-700 mb-8">
                            <p>Wollen Sie wirklich Ihren Account löschen?</p>
                            <p>Dieser Vorgang ist nicht umkehrbar.</p>
                        </div>
                        <div class="flex justify-center">
                            <button @click={showDeleteModal=false} class="bg-gray-300 text-gray-900 rounded hover:bg-gray-200 px-6 py-2 focus:outline-none mx-1">Abbrechen</button>
                            <button type="submit" form="deleteUser" class="bg-red-500 text-gray-200 rounded hover:bg-red-400 px-6 py-2 focus:outline-none mx-1">Löschen</button>
                        </div>
                    </div>
                </div>
                <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
            </div>

        </div>
    </div>
@endsection
