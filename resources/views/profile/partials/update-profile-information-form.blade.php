<section>
    <div class="grid grid-flow-col auto-cols-max gap-6">
        <div>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            {{-- in the profile update put the code to update alls the fields of the person --}}
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
        </div>
        <div>
            <div>
                <x-input-label for="first_name" :value="__('Voornaam')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ Auth::user()->person->first_name }}" required autofocus />
            </div>

            <div>
                <x-input-label for="last_name" :value="__('Achternaam')" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ Auth::user()->person->last_name }}" required autofocus />
            </div>

            <div>
                <x-input-label for="date_of_birth" :value="__('Geboortedatum')" />
                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" value="{{ Auth::user()->person->date_of_birth }}" required autofocus />
            </div>

            <div>
                <x-input-label for="burger_service_nummer" :value="__('BurgerServiceNummer')" />
                <x-text-input id="burger_service_nummer" class="block mt-1 w-full" type="text" name="burger_service_nummer" value="{{ Auth::user()->person->burger_service_nummer }}" required autofocus />
            </div>
        </div>
        <div>
            <div>
                <x-input-label for="phone" :value="__('Telefoonnr')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ Auth::user()->person->phone }}" required autofocus />
            </div>

            <div>
                <x-input-label for="personal_email" :value="__('Persoonlijke e-mail')" />
                <x-text-input id="personal_email" class="block mt-1 w-full" type="text" name="personal_email" value="{{ Auth::user()->person->personal_email }}" required autofocus />
            </div>

            <div>
                <x-input-label for="notes" :value="__('Notities')" />
                <x-text-area-input id="notes" class="block mt-1 w-full"  name="notes" value="{{ Auth::user()->person->notes }}" required autofocus />
            </div>
        </div>
        <div>
            <div>
                <x-input-label for="address" :value="__('Adres')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ Auth::user()->person->address }}" required autofocus />
            </div>

            <div>
                <x-input-label for="postal_code" :value="__('Postcode')" />
                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" value="{{ Auth::user()->person->postal_code }}" required autofocus />
            </div>

            <div>
                <x-input-label for="city" :value="__('Woonplaats')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" value="{{ Auth::user()->person->city }}" required autofocus />
            </div>

            <div>
                <x-input-label Land="country" :value="__('Land')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" value="{{ Auth::user()->person->country }}" required autofocus />
            </div>
            </form>
        </div>
    </div>
</section>
