<x-app-layout>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            @livewire('menulink')
            
            <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('list-users')
            </div>
        </div>
    </div>
   
</x-app-layout>
