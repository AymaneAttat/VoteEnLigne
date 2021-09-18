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
            Condidat Formulaire
        </h3><br>
        <form method="POST" action="{{ route('condidat.store') }}">
            @csrf
            <div class="mt-4">
                <x-label for="nom" :value="__('Nom')" />
                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="prenom" :value="__('Prenom')" />
                <x-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus />
            </div>
            <div class="mt-4">
                <x-label for="end_vote_id" :value="__('Délai Vote')" />
                <select id="end_vote_id" name="end_vote_id" class="block mt-1 w-full" placeholder="Choisir Délai de vote...">
                    <option value=""></option>
                    @forelse ($endvotes as $end)
                        <option value="{{ $end->id }}">{{ $end->end_vote }}</option>
                    @empty
                        <option>vide</option>
                    @endforelse
                </select>
                
            </div>
            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />
                <textarea class="block mt-1 w-full" id="description" name="description" value="old('description')" rows="3"></textarea>
            </div>
            <x-input id="votes" name="votes" type="hidden" value="0" />
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Créer Un Condidat') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>