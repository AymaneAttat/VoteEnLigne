<x-app-layout>
    <x-slot name="header">
         <div>
            @can('index.vote.condidat')
               @if (Auth::user()->is_admin)
                  <a href="{{ route('condidat.vote') }}"> <x-button class="px-6 py-2 rounded-full hover:bg-green-500 hover:text-white-100 float-right">{{ __('Actualiser les votes') }}</x-button></a>
               @endif
            @endcan 
         </div>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
         </h2>   
    </x-slot>
   @if (!empty($nbvote) || !empty($nbvoteTrashed) || !empty($condidat))
   <br>
      <div class="p-4 flex items-center  justify-center mx-11">
        <div class="w-full  mb-12 justify-center rounded-lg text-white bg-gray-900">
           <h3 class="text-white p-3 md:text-2xl lg:text-2xl text-lg"></h3>
           <div class="p-5 pt-1 flex-wrap  flex items-center gap-2 justify-center">
               <div class="bg-gradient-to-r flex-auto  w-42 h-42  from-gray-800 to-gray-700    shadow-lg    rounded-lg">
                 <div class="md:p-7 p-4">
                    <h2 class="text-xl text-center text-gray-200 capitalize">{{$nbvote}} </h2>
                    <h3 class="text-sm  text-gray-400  text-center">Vote(s) </h3>
                 </div>
              </div>
              <div class="bg-gradient-to-r flex-auto w-42 h-42  from-gray-800 to-gray-700    shadow-lg    rounded-lg">
                 <div class="md:p-7 p-4">
                    <h2 class="text-xl text-center text-gray-200 capitalize">{{$nbvoteTrashed}} </h2>
                    <h3 class="text-sm  text-gray-400  text-center">Vote Eliminer</h3>
                 </div>
              </div>
              
              <div class="bg-gradient-to-r flex-auto  w-42 h-42  from-gray-800 to-gray-700    shadow-lg    rounded-lg">
                 <div class="md:p-7 p-4">
                    <h2 class="text-lg text-center text-gray-200 capitalize" style="">{{$condidat->nom}} </h2>
                    <h3 class="text-sm  text-gray-400  text-center">Avancez pour ce moment</h3>
                 </div>
              </div>
           </div>
        </div>
      </div> 
   @else
      <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 bg-white border-b border-gray-200">
                     Bienvenue @if(Auth::user()->is_admin) Administrateur @endif {{ Auth::user()->name}} @if((Auth::user()->role_id == 4) && (Auth::user()->voted)), Vous êtes déjà voté @elseif(Auth::user()->role_id != 4) @else, Votez maintenant @endif
               </div>
            </div>
         </div>
      </div>
   @endif 
   
</x-app-layout>
