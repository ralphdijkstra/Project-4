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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <div>
                    <x-input-label for="first_name" :value="__('Voornaam')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $person->first_name }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Achternaam')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ $person->last_name }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="date_of_birth" :value="__('Geboortedatum')" />
                    <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" value="{{ $person->date_of_birth }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="burger_service_nummer" :value="__('BurgerServiceNummer')" />
                    <x-text-input id="burger_service_nummer" class="block mt-1 w-full" type="text" name="burger_service_nummer" value="{{ $person->burger_service_nummer }}" required autofocus />
                </div>
            </div>
            <div>
                <div>
                    <x-input-label for="phone" :value="__('Telefoonnr')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $person->phone }}" required autofocus />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Persoonlijke e-mail')" />
                    <x-text-input id="personal_email" class="block mt-1 w-full" type="text" name="personal_email" value="{{ $person->personal_email }}" required autofocus />
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
            </div>
            <div>
                <div>
                    <x-input-label for="notes" :value="__('E-mailadres')" />
                    <x-text-area-input id="notes" class="block mt-1 w-full" name="notes" value="{{ $person->notes }}"  autofocus />
                </div>
            </div>
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
