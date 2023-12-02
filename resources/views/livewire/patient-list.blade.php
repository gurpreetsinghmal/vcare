<div>
    <div class="container my-4 mx-auto">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="m-3 flex justify-between">
                <div class="flex justify-between mb-4 w-96">
                    <input placeholder="Search with Name or Mobile or Husband Name" type="text" name="search" id="search" wire:model.debounce.500ms="search" class="rounded-lg px-2  py-2 w-full border">
                </div>
                <div class="font-bold">
                    <div>District : {{$dist[Auth::user()->id]}}</div>
                    <div>Block : {{$block[Auth::user()->id]}}</div>
                </div>

            </div>

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-200 uppercase bg-slate-600">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Mobile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Husband Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Block
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Village
                        </th>
                        <th scope="col" class="px-6 py-3">
                            EDD
                        </th>

                        <th scope="col" class="py-3 text-center text-lg">
                            Total : {{$patients->count()}}
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($patients as $user)

                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{$user->mobile??"NA" }}
                        </td>
                        <td scope="row" class="uppercase px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{$user->name??"NA" }}
                        </td>

                        <td class="px-6 py-4 uppercase">
                            {{$user->husbandName??"NA" }}
                        </td>
                        <td class="px-6 py-4">
                            {{$this->getblock($user->village_id) }}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->village->name??"NA" }}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->edd??"NA"}}
                        </td>

                        <td class="px-3 py-4 text-right">
                            <x-button wire:click="viewdetails({{$user->id}})">
                                View
                            </x-button>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="2" class="py-4 px-4">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
    <x-confirmation-modal wire:model="viewpatient">
        <x-slot name="title">Patient Complete Details</x-slot>

        <x-slot name="content">
            @if($completedetails)
            <table class="w-full border uppercase">
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">Name</td>
                    <td>{{$completedetails->name}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">Husband Name</td>
                    <td>{{$completedetails->husbandName}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">Village</td>
                    <td>{{$completedetails->village->name}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">Mobile</td>
                    <td>{{$completedetails->mobile}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">abhaId</td>
                    <td>{{$completedetails->abhaId}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">bloodgroup</td>
                    <td>{{$completedetails->bloodgroup}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">ayushmanId</td>
                    <td>{{$completedetails->ayushmanId}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">currDeliveryCount</td>
                    <td>{{$completedetails->currDeliveryCount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">prevChildAge</td>
                    <td>{{$completedetails->prevChildAge}} Year</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">previousDeliveryType</td>
                    <td>{{$completedetails->previousDeliveryType=="0"?"Normal":"Ceaseran"}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">sexPreviousChild</td>
                    <td>{{$completedetails->sexPreviousChild=="M"?"Male":"Female"}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">tt1switch</td>
                    <td>{{$completedetails->tt1switch}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">tt2switch</td>
                    <td>{{$completedetails->tt2switch}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">ttbswitch</td>
                    <td>{{$completedetails->ttbswitch}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">counsDiet</td>
                    <td>{{$completedetails->counsDiet=="1"?"Yes":"No"}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">asha name</td>
                    <td>@if($completedetails->asha_id)
                        {{$this->getuser($completedetails->asha_id)}}
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anm name</td>
                    <td>@if($completedetails->anm_id)
                        {{$this->getuser($completedetails->asha_id)}}
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">gdmo name</td>
                    <td>@if($completedetails->gdmo_id)
                        {{$this->getuser($completedetails->gdmo_id)}}
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">gyno name</td>
                    <td>@if($completedetails->gyno_id)
                        {{$this->getuser($completedetails->gyno_id)}}
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">MO name</td>
                    <td>@if($completedetails->doctor_id)
                        {{$this->getuser($completedetails->doctor_id)}}
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">rchid</td>
                    <td>{{$completedetails->rchid}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">caseno</td>
                    <td>{{$completedetails->caseno}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">mothername</td>
                    <td>{{$completedetails->mothername}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">ageatmarriage</td>
                    <td>{{$completedetails->ageatmarriage}} Years</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">dob</td>
                    <td>{{$completedetails->dob}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">bankname</td>
                    <td>{{$completedetails->bankname}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">accountno</td>
                    <td>{{$completedetails->accountno}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">ifsccode</td>
                    <td>{{$completedetails->ifsccode}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">caste</td>
                    <td>{{$completedetails->caste}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">economy</td>
                    <td>{{$completedetails->economy}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">address</td>
                    <td>{{$completedetails->address}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">Lmp</td>
                    <td>{{$completedetails->Lmp}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">edd</td>
                    <td>{{$completedetails->edd}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">weight</td>
                    <td>{{$completedetails->weight}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">heightf</td>
                    <td>{{$completedetails->heightf}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">heighti</td>
                    <td>{{$completedetails->heighti}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">pastillness</td>
                    <td>{{$completedetails->pastillness}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_date</td>
                    <td>{{$completedetails->anc1_date}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_weekofpregnancy</td>
                    <td>{{$completedetails->anc1_weekofpregnancy}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_bpSystolic</td>
                    <td>{{$completedetails->anc1_bpSystolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_bpDiastolic</td>
                    <td>{{$completedetails->anc1_bpDiastolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_bloodsugarfasting</td>
                    <td>{{$completedetails->anc1_bloodsugarfasting}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_bloodsugarpost</td>
                    <td>{{$completedetails->anc1_bloodsugarpost}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_highrisk</td>
                    <td>{{$completedetails->anc1_highrisk}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_hblevel</td>
                    <td>{{$completedetails->anc1_hblevel}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_urinesugar</td>
                    <td>{{$completedetails->anc1_urinesugar}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_urinealbumin</td>
                    <td>{{$completedetails->anc1_urinealbumin}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_folictabcount</td>
                    <td>{{$completedetails->anc1_folictabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_folicdate</td>
                    <td>{{$completedetails->anc1_folicdate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_ifatabcount</td>
                    <td>{{$completedetails->anc1_ifatabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_ifadate</td>
                    <td>{{$completedetails->anc1_ifadate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_fundalheight</td>
                    <td>{{$completedetails->anc1_fundalheight}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_Foetalheartrate</td>
                    <td>{{$completedetails->anc1_Foetalheartrate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_FoetalMovements</td>
                    <td>{{$completedetails->anc1_FoetalMovements}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_usg</td>
                    <td>{{$completedetails->anc1_usg}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc1_counselling</td>
                    <td>{{$completedetails->anc1_counselling}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_date</td>
                    <td>{{$completedetails->anc2_date}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_weekofpregnancy</td>
                    <td>{{$completedetails->anc2_weekofpregnancy}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_bpSystolic</td>
                    <td>{{$completedetails->anc2_bpSystolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_bpDiastolic</td>
                    <td>{{$completedetails->anc2_bpDiastolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_bloodsugarfasting</td>
                    <td>{{$completedetails->anc2_bloodsugarfasting}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_bloodsugarpost</td>
                    <td>{{$completedetails->anc2_bloodsugarpost}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_highrisk</td>
                    <td>{{$completedetails->anc2_highrisk}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_hblevel</td>
                    <td>{{$completedetails->anc2_hblevel}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_urinesugar</td>
                    <td>{{$completedetails->anc2_urinesugar}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_urinealbumin</td>
                    <td>{{$completedetails->anc2_urinealbumin}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_folictabcount</td>
                    <td>{{$completedetails->anc2_folictabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_folicdate</td>
                    <td>{{$completedetails->anc2_folicdate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_ifatabcount</td>
                    <td>{{$completedetails->anc2_ifatabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_ifadate</td>
                    <td>{{$completedetails->anc2_ifadate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_fundalheight</td>
                    <td>{{$completedetails->anc2_fundalheight}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_Foetalheartrate</td>
                    <td>{{$completedetails->anc2_Foetalheartrate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_FoetalMovements</td>
                    <td>{{$completedetails->anc2_FoetalMovements}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_usg</td>
                    <td>{{$completedetails->anc2_usg}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc2_counselling</td>
                    <td>{{$completedetails->anc2_counselling}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_date</td>
                    <td>{{$completedetails->anc3_date}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_weekofpregnancy</td>
                    <td>{{$completedetails->anc3_weekofpregnancy}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_bpSystolic</td>
                    <td>{{$completedetails->anc3_bpSystolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_bpDiastolic</td>
                    <td>{{$completedetails->anc3_bpDiastolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_bloodsugarfasting</td>
                    <td>{{$completedetails->anc3_bloodsugarfasting}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_bloodsugarpost</td>
                    <td>{{$completedetails->anc3_bloodsugarpost}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_highrisk</td>
                    <td>{{$completedetails->anc3_highrisk}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_hblevel</td>
                    <td>{{$completedetails->anc3_hblevel}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_urinesugar</td>
                    <td>{{$completedetails->anc3_urinesugar}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_urinealbumin</td>
                    <td>{{$completedetails->anc3_urinealbumin}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_folictabcount</td>
                    <td>{{$completedetails->anc3_folictabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_folicdate</td>
                    <td>{{$completedetails->anc3_folicdate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_ifatabcount</td>
                    <td>{{$completedetails->anc3_ifatabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_ifadate</td>
                    <td>{{$completedetails->anc3_ifadate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_fundalheight</td>
                    <td>{{$completedetails->anc3_fundalheight}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_Foetalheartrate</td>
                    <td>{{$completedetails->anc3_Foetalheartrate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_FoetalMovements</td>
                    <td>{{$completedetails->anc3_FoetalMovements}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_usg</td>
                    <td>{{$completedetails->anc3_usg}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc3_counselling</td>
                    <td>{{$completedetails->anc3_counselling}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_date</td>
                    <td>{{$completedetails->anc4_date}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_weekofpregnancy</td>
                    <td>{{$completedetails->anc4_weekofpregnancy}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_bpSystolic</td>
                    <td>{{$completedetails->anc4_bpSystolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_bpDiastolic</td>
                    <td>{{$completedetails->anc4_bpDiastolic}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_bloodsugarfasting</td>
                    <td>{{$completedetails->anc4_bloodsugarfasting}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_bloodsugarpost</td>
                    <td>{{$completedetails->anc4_bloodsugarpost}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_highrisk</td>
                    <td>{{$completedetails->anc4_highrisk}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_hblevel</td>
                    <td>{{$completedetails->anc4_hblevel}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_urinesugar</td>
                    <td>{{$completedetails->anc4_urinesugar}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_urinealbumin</td>
                    <td>{{$completedetails->anc4_urinealbumin}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_folictabcount</td>
                    <td>{{$completedetails->anc4_folictabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_folicdate</td>
                    <td>{{$completedetails->anc4_folicdate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_ifatabcount</td>
                    <td>{{$completedetails->anc4_ifatabcount}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_ifadate</td>
                    <td>{{$completedetails->anc4_ifadate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_fundalheight</td>
                    <td>{{$completedetails->anc4_fundalheight}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_Foetalheartrate</td>
                    <td>{{$completedetails->anc4_Foetalheartrate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_FoetalMovements</td>
                    <td>{{$completedetails->anc4_FoetalMovements}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_usg</td>
                    <td>{{$completedetails->anc4_usg}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">anc4_counselling</td>
                    <td>{{$completedetails->anc4_counselling}}</td>
                </tr>
                
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">JSYBeneficiary</td>
                    <td>{{$completedetails->JSYBeneficiary}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">badhistory</td>
                    <td>{{$completedetails->badhistory}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">badhistoryDetails</td>
                    <td>{{$completedetails->badhistoryDetails}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">siteofdelivery</td>
                    <td>{{$completedetails->siteofdelivery}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">refergyno</td>
                    <td>{{$completedetails->refergyno}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">mcp</td>
                    <td>{{$completedetails->mcp}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">modeofdelivery</td>
                    <td>{{$completedetails->modeofdelivery}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">dateofdelivery</td>
                    <td>{{$completedetails->dateofdelivery}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">sexofchild</td>
                    <td>{{$completedetails->sexofchild}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">regdate</td>
                    <td>{{$completedetails->regdate}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">para</td>
                    <td>{{$completedetails->para}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">gravida</td>
                    <td>{{$completedetails->gravida}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">abortion</td>
                    <td>{{$completedetails->abortion}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">living</td>
                    <td>{{$completedetails->living}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">explained108</td>
                    <td>{{$completedetails->explained108}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">avail108</td>
                    <td>{{$completedetails->avail108}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">doctorAttend</td>
                    <td>{{$completedetails->doctorAttend}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">nurseAttend</td>
                    <td>{{$completedetails->nurseAttend}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">kangaroo</td>
                    <td>{{$completedetails->kangaroo}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">delayCord</td>
                    <td>{{$completedetails->delayCord}}</td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-2">ballariRakhiya</td>
                    <td>{{$completedetails->ballariRakhiya}}</td>
                </tr>
            </table>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="toggle('viewpatient')">Close</x-button>
        </x-slot>

    </x-confirmation-modal>

</div>