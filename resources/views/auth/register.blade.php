<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <!--<a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>-->
            <a href="/">
                <img class="w-60 h-40 fill-current text-gray-500" src="{{asset('test3.png')}}"/>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <h3 class="text-center text-3xl leading-9 font-bold tracking-tight text-gray-800 sm:text-4xl sm:leading-10">
            Inscription Formulaire
        </h3><br>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <!-- Code Identité Nationnal -->
            <div class="mt-4">
                <x-label for="cin" :value="__('Code Identité Nationnal')" />
                <x-input id="cin" class="block mt-1 w-full" type="text" name="cin" :value="old('cin')" required autofocus />
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
