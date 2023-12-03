<div>
        @if(Auth::user()->role->id>4)
        <div>
                @if(Auth::user()->role->id==5)
                <span>Reporting Stats - Block :{{$block->block->name}}</span>

                @elseif(Auth::user()->role->id==6)
                <span>Reporting Stats - District : {{$block->district->name}}</span>

                @endif
                <div class="grid grid-cols-3 gap-3 text-white mb-2">
                        <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Total Cases</span><span wire:click="report_total()" class="font-bold text-white cursor-pointer text-xl">{{$stat["total"]}}</span>
                        </div>
                        <div class="bg-green-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Delivered Cases</span><span wire:click="report_deliver()" class="font-bold cursor-pointer text-white text-xl">{{$stat["delivered"]}}</span>
                        </div>
                        <div class="bg-blue-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>High Risk Cases</span><span wire:click="report_highrisk()" class="font-bold cursor-pointer text-white text-xl">{{$stat["highrisk"]}}</span>
                        </div>
                </div>
                <div class="grid mb-2 grid-cols-4 gap-3 text-white">

                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC1</span><span wire:click="report_anc1()" class="font-bold cursor-pointer text-white text-xl">{{$stat["anc1"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC2</span><span wire:click="report_anc2()" class="font-bold cursor-pointer text-white text-xl">{{$stat["anc2"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC3</span><span wire:click="report_anc3()" class="font-bold cursor-pointer text-white text-xl">{{$stat["anc3"]}}</span>
                        </div>
                        <div class="bg-rose-400 p-3 rounded-lg h-16 flex justify-between">
                                <span>Pending ANC4</span><span wire:click="report_anc4()" class="font-bold cursor-pointer text-white text-xl">{{$stat["anc4"]}}</span>
                        </div>


                </div>

        </div>
        @endif

        <div class="mb-2 p-3 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="/mapping" class="bg-pink-800 p-2 text-white rounded-md">Mapping</a>
                <a href="/changepwd" class="bg-pink-800 p-2  text-white rounded-md">Edit User</a>
                @if(Auth::user()->role->id==6 ||Auth::user()->role->id==5 )
                <a href="/patientlist" class="bg-pink-800 p-2  text-white rounded-md">Patient List</a>
                @endif
        </div>
        <x-confirmation-modal wire:model="reporttotalmodal">
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
                        <x-secondary-button wire:click="toggle('reporttotalmodal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reportdelivermodal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of Delivered Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_deliver as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                 <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reportdelivermodal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reporthighriskmodal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of High Risk Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_highrisk as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reporthighriskmodal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reportanc1modal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of ANC1 Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_anc1 as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reportanc1modal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reportanc2modal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of ANC2 Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_anc2 as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reportanc2modal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reportanc3modal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of ANC3 Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_anc3 as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reportanc3modal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="reportanc4modal">
                <x-slot name="icon">

                </x-slot>
                <x-slot name="subtitle">

                </x-slot>

                <x-slot name="title">
                        Details of ANC4 Cases
                </x-slot>


                <x-slot name="content">
                        <table class="min-w-full bg-white uppercase border border-gray-300">
                                <thead>
                                        <tr class="bg-slate-700 text-white">
                                                <th class="py-2 px-4 border-b">name<br />husband name</th>
                                                <th class="py-2 px-4 border-b">mobile</th>
                                                <th class="py-2 px-4 border-b">block<br />village</th>
                                                <th class="py-2 px-4 border-b">anm</th>
                                                <th class="py-2 px-4 border-b">asha</th>

                                        </tr>
                                </thead>

                                <tbody>
                                        @foreach($data_anc4 as $d)
                                        <tr class="hover:bg-slate-100">
                                                <td class="py-2 px-4 border-b">{{$d->name}}<br />{{$d->husbandName}}</td>
                                                <td class="py-2 px-4 border-b">{{$d->mobile}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getblock($d->village_id)}}<br />{{$d->village->name}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getanm($d->village_id)}}</td>
                                                <td class="py-2 px-4 border-b">{{$this->getuser($d->asha_id)}}</td>

                                        </tr>
                                        @endforeach
                                </tbody>
                        </table>
                </x-slot>
                <x-slot name="footer">
                        <x-secondary-button wire:click="toggle('reportanc4modal')" wire:loading.attr="disabled">
                                Cancel
                        </x-secondary-button>


                </x-slot>
        </x-confirmation-modal>


</div>