@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="p-3 flex justify-between align-middle">
                <div class="text-3xl">
                    Profil von {{ $user->username }}
                </div>

                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">
                        <div class="bg-gray-200 rounded-lg p-1">
                            Profil bearbeiten
                        </div>
                    </a>
                @endcan
            </div>

            <div class="flex justify-between p-3">

                <div class="w-1/4 bg-white p-3">
                    <img src="/storage/{{ $user->profile->image }}" class="shadow rounded-full max-w-full h-auto align-middle border-none">
                </div>
                <div class="w-3/4 bg-gray-100 shadow rounded-lg p-3 flex flex-col justify-between">
                    <div>
                        <div class="text-lg px-3">
                            Name: {{ $user->name }} <br/>
                        </div>
                        <div class="py-5">
                            <div class="font-bold text-2xl p-3">
                                Beschreibung
                            </div>
                            <div class="px-3">
                                {{ $user->profile->description }}
                            </div>
                        </div>
                    </div>
                    <div>
                        Mitglied seit {{ $user->created_at->format('d/m/Y') }}
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
