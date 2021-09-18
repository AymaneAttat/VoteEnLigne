<x-guest-layout>
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="w-60 h-40 fill-current text-gray-500" src="{{asset('test3.png')}}"/>
            </a>
        </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <h3 class="text-center text-3xl leading-9 font-bold tracking-tight text-gray-800 sm:text-4xl sm:leading-10">
            Vote Formulaire
        </h3><br>
        <form method="POST" action="{{ route('vote.store') }}">
            @csrf
            @auth
                <div class="mt-4">
                    <x-label for="prenom" :value="__('Prenom')" />
                    <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="naissance" :value="__('Naissance')" />
                    <x-input id="naissance" class="block mt-1 w-full" type="text" name="naissance" :value="old('naissance')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="condidat_nom" :value="__('Condidat Liste')" />
                    
                    <select id="condidat_nom" name="condidat_nom" class="block mt-1 w-full" placeholder="Choisir votre condidat...">
                        <option value=""></option>
                        @forelse ($condidats as $con)
                            <option value="{{ $con->nom }}">{{ $con->nom }}</option>
                        @empty
                            <option>vide</option>
                        @endforelse
                    </select>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Auth::user()->role_id == 4 && Auth::user()->voted == 0)
                        <p class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Vous Avez le droit de voter une seule fois') }}
                        </p>
                        <x-button class="ml-4">
                            {{ __('Voter') }}
                        </x-button>
                    @elseif (Auth::user()->role_id != 4)
                        <p class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __("Vous n'avez pas le droit de voter") }}
                        </p>
                    @else
                        <p class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Vous êtes déjà voté') }}
                        </p>
                    @endif
                    
                </div>
            @else   
                <div class="mt-4">
                    <x-label for="nom" :value="__('Nom')" />
                    <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="prenom" :value="__('Prenom')" />
                    <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="naissance" :value="__('Naissance')" />
                    <x-input id="naissance" class="block mt-1 w-full" type="text" name="naissance" :value="old('naissance')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="cin" :value="__('Code Identité Nationnal')" />
                    <x-input id="cin" class="block mt-1 w-full" type="text" name="cin" :value="old('cin')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
                <div class="mt-4">
                    <x-label for="condidat_nom" :value="__('Condidat Liste')" />
                    
                    <select id="condidat_nom" name="condidat_nom" class="block mt-1 w-full" placeholder="Choisir votre condidat...">
                        <option value=""></option>
                        @forelse ($condidats as $con)
                            <option value="{{ $con->nom }}">{{ $con->nom }}</option>
                        @empty
                            <option>vide</option>
                        @endforelse
                    </select>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <p class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Vous Avez le droit de voter une seule fois') }}
                    </p>

                    <x-button class="ml-4">
                        {{ __('Voter') }}
                    </x-button>
                </div>
            @endauth   
        </form>
    </x-auth-card>
</x-guest-layout>