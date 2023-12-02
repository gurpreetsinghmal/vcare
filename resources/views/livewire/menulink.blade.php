<div>
        @if(Auth::user()->role->id>4)
        <div>
                @if(Auth::user()->role->id==5)
                <span>Reporting Stats - Block :{{$block->block->name}}</span>
                <div class="grid grid-cols-2 gap-3 text-white mb-2">
                        <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Total Cases</span><span wire:click="report()" class="font-bold text-white cursor-pointer text-xl">{{$stat["total"]}}</span>
                        </div>
                        <div class="bg-green-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Delivered Cases</span><span class="font-bold text-white text-xl">{{$stat["delivered"]}}</span>
                        </div>
                </div>
                @elseif(Auth::user()->role->id==6)
                <span>Reporting Stats - District : {{$block->district->name}}</span>
                <div class="grid grid-cols-3 gap-3 text-white mb-2">
                        <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Total Cases</span><span wire:click="report()" class="font-bold text-white cursor-pointer text-xl">{{$stat["total"]}}</span>
                        </div>
                        <div class="bg-green-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Delivered Cases</span><span class="font-bold text-white text-xl">{{$stat["delivered"]}}</span>
                        </div>
                         <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>High Risk Cases</span><span class="font-bold text-white text-xl">{{$stat["highrisk"]}}</span>
                        </div>
                </div>
                @endif
                <div class="grid mb-2 grid-cols-4 gap-3 text-white">

                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC1</span><span class="font-bold text-white text-xl">{{$stat["anc1"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC2</span><span class="font-bold text-white text-xl">{{$stat["anc2"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC3</span><span class="font-bold text-white text-xl">{{$stat["anc3"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC4</span><span class="font-bold text-white text-xl">{{$stat["anc4"]}}</span>
                        </div>


                </div>
             
        </div>
        @endif

        <div class="mb-2 p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="/mapping" class="bg-pink-800 p-2 text-white rounded-md">Mapping</a>
                <a href="/changepwd" class="bg-pink-800 p-2  text-white rounded-md">Edit User</a>
        </div>
        <x-confirmation-modal wire:model="reportmodal">
        <x-slot name="icon">
            
        </x-slot>
        <x-slot name="subtitle">

        </x-slot>

        <x-slot name="title">
            Stats of Team Cases
        </x-slot>


        <x-slot name="content">
                <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Cases</th>
                    
                </tr>
            </thead>

            <tbody>
                @foreach($repo as $n=>$c)
                 <tr class="hover:bg-slate-100">
                        <td class="py-2 px-4 border-b">{{$n}}</td>
                        <td class="py-2 px-4 border-b">{{$c}}</td>
                 </tr>
                @endforeach
            </tbody>
                </table>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="toggle()" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            
        </x-slot>
        </x-confirmation-modal>
</div>