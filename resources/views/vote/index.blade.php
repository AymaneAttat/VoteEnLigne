<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vote Liste') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-1 lg:px-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-3 p-6 bg-white border-b border-gray-200">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    
                     <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <h3 class="text-center text-3xl leading-9 font-bold tracking-tight text-gray-800 sm:text-4xl sm:leading-10">
                        {{ $votes->count() }} vote(s)
                    </h3><br>
                    <table class="table-auto w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold">
                                <th class="border px-4 py-4">ID</th>
                                <th class="border px-4 py-4">Confirmer</th> 
                                <th class="border px-4 py-4">Prenom</th>
                                <th class="border px-4 py-4">Nom</th>
                                <th class="border px-4 py-4">Identité National</th>
                                <th class="border px-4 py-4">Email</th>                                
                                <th class="border px-4 py-4">Date Vote</th>
                                <th class="border px-4 py-4">Condidat a voté</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($votes as $vote)
                                <tr>
                                    <td class="border px-4 py-4">{{ $vote->id }}</td>
                                    <td class="border px-4 py-4">
                                        @if (!$vote->deleted_at)
                                            <form method="post" action="{{ route('vote.destroy', $vote->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                        {{ __('Pas Accepter') }}
                                                </button>
                                            </form>
                                        @else
                                            <form method="post" action="{{ route('vote.restore', $vote->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <x-button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                        {{ __('Restorer') }}
                                                </x-button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-4">{{ $vote->nom }}</td>
                                    <td class="border px-4 py-4">{{ $vote->prenom }}</td>
                                    <td class="border px-4 py-4">{{ $vote->cin }}</td>
                                    <td class="border px-4 py-4">{{ $vote->email }}</td>                                   
                                    <td class="border px-4 py-4">{{ $vote->created_at->diffForHumans() }}</td>
                                    <td style="column-width: 1px" class="overflow-hidden px-1 border px-4 py-4"><small>{{ $vote->condidat_nom }} </small></td><!-- {$vote->condidat->nom}},{$vote->condidat->id}} by -->
                                </tr>
                            @empty
                                <tr>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table><br>
                    @can('countVote')
                    <a href="{{ route('condidat.vote') }}"><button class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 float-right">{{ __('Confirmer les votes') }}</button></a><br> 
                    @endcan
                            
                </div>
            </div>
        </div>
    </div>
</x-app-layout>