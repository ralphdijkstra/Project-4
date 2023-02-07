@extends('layouts.dashboard')

@section('content')
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('persons.update', [$person]) }}">
        @csrf
        @method('put')
                <div>
                    <x-input-label for="name" :value="__('Naam')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $person->user->name }}" required autofocus />
                </div>
                <div>
                    <x-input-label for="phone" :value="__('Telefoonnr')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $person->phone }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="address" :value="__('Adres')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $person->address }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="postal_code" :value="__('Postcode')" />
                    <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" value="{{ $person->postal_code }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="city" :value="__('Woonplaats')" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ $person->city }}" required autofocus />
                </div>
                <div>
                    <x-input-label for="email" :value="__('E-mailadres')" />
                    <x-text-input id="email" class="block mt-1 w-full" name="email" type="text" value="{{ $person->user->email }}" required autofocus />
                </div>
        <div class="mt-2">
            <select class="form-control" name="roles[]" multiple="">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $person->user->roles()->get()->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Werk gegevens bij') }}
            </x-primary-button>
        </div>
    </form>
@endsection
