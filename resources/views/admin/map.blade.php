<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
             @livewire('menulink')
             <div class="mb-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if(Auth::user()->role_id==6)
                 @livewire('mapuser')
            @endif
             </div>
           
        </div>
    </div>
   
</x-app-layout>
