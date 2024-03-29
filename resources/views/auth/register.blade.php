<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('registers') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" value="{{ $name }}" type="text" name="name"
                    required autofocus/>
            </div>
            <div>
                this name get from <a href="https://fakerphp.github.io/">fakerphp</a>. you can edit username, if you want your identity show you can use username default
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"
                    required />
            </div>
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>
            {{-- <div class="mt-4">
                <x-jet-label for="ip_user" value="{{ __('ip_user') }}" /> --}}
            <x-jet-input id="ip_user" class="block mt-1 w-full" type="hidden" value="{{ $ip_user }}" name="ip_user"
                required />
            {{-- </div> --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
