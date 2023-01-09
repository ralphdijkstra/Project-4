{{-- just for changing the roles of a user
for changing user info see update profile info form --}}
@extends('layouts.dashboard')

@section('content')
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('users.update', [$user]) }}">
        @csrf
        @method('put')
        <div class="text-xl">Wijzig de rol(len) voor:</div>
        <div class="text-xl">{{ $user->name }}</div>
        <div class="mt-2">
            <select class="form-control" name="roles[]" multiple="">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->roles()->get()->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Wijzig rollen') }}
            </x-primary-button>
        </div>
    </form>
@endsection
