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
                <img class="w-80 h-70 fill-current text-gray-500" src="{{asset('test3.png')}}"/>
            </a>
        </x-slot>
        <h3 class="text-center text-3xl leading-9 font-bold tracking-tight text-gray-800 sm:text-4xl sm:leading-10">
            Bienvenue sur vote électronique<br> 
        </h3>  
        <div class="flex items-center justify-center">
            <a href="{{ route('vote.create') }}"><x-button class="px-6 py-2 rounded-full hover:bg-blue-500 hover:text-white-100">{{ __('Voter Maintenant') }}</x-button></a>
        </div>
        <!-- <br><small><i>1) Voter pour votre condidat.</i> </small><br>
        <small><i>2) Authentifier <b>aprés votage</b>  pour voir résultat</i> </small>  -->  
    </x-auth-card>
</x-guest-layout>