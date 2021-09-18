<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste Condidat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <div>
                        <div class="float-right"><x-button><a href="{{route('condidat.create')}} ">Ajoute Condidat</a></x-button></div>
                        <h4>{{ $condidats->count() }} Condidat(s)</h4>
                    </div><br>
                    <table class="table-auto w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold">
                                <th class="border px-4 py-4">ID</th>
                                <th class="border px-4 py-4">Prenom</th>
                                <th class="border px-4 py-4">Nom</th>
                                <th class="border px-4 py-4">Descroption</th>
                                <th class="border px-4 py-4">Vote</th>
                                <th class="border px-4 py-4">Date Creation</th>
                                <!----> <th class="border px-4 py-4">Délai vote</th> 
                                <th class="border px-4 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @forelse ($condidats as $condidat)
                                <tr>
                                    <td class="border px-4 py-4">{{ $condidat->id }}</td>
                                    <td class="border px-4 py-4">{{ $condidat->prenom }}</td>
                                    <td class="border px-4 py-4">{{ $condidat->nom }}</td>
                                    <td class="border px-4 py-4">{{ $condidat->description }}</td>
                                    <td class="border px-4 py-4">{{ $condidat->votes }}</td>
                                    <td class="border px-4 py-4">{{ $condidat->created_at->diffForHumans() }}</td>
                                    <!----><td class="border px-4 py-4">{{ optional($condidat->votestimeout)->end_vote }}</td> 
                                    <td class="border px-4 py-4">
                                        @if (!$condidat->deleted_at)
                                            <form method="post" action="{{ route('condidat.destroy', $condidat->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-500 focus:outline-none focus:border-red-500 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                        {{ __('Pas Accepter') }}
                                                </button>
                                            </form>
                                        @else
                                            <form method="post" action="{{ route('condidat.restore', $condidat->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <x-button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                        {{ __('Restorer') }}
                                                </x-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <td class="border px-4 py-4">Vide</td>
                                    <!----> <td class="border px-4 py-4">Vide</td> 
                                    <td class="border px-4 py-4">Vide</td>
                                </tr>
                                @endforelse
                                
                                {{ $condidats->links() }}
                        </tbody>
                    </table><br>
                    <div>
                        <a href="{{ route('condidat.vote') }}"><button class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-500 focus:outline-none focus:border-blue-500 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 float-right">{{ __('Actualiser les votes') }}</button></a>
                        <button id="openModal" class="openModal inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Créer un délai de vote') }}</button>
                        <!--id="delete-btn" <a href="{-{ route('vote_deadline.create') }}" class="modal-open"><button class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{-{ __('Créer un délai de vote') }}</button></a> -->
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @include('condidat.modal.create')
    <!-- @@include('condidat.modal.create') wire:click="ModalCreate"-->
</x-app-layout>