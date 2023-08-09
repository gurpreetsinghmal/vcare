<div>
    <div class="container my-4 mx-auto">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <div class="m-3 flex justify-between">
                <div class="flex justify-between mb-4 w-96">
                    <input placeholder="Search with name or mobile or email" type="text" name="search" id="search" wire:model.debounce.500ms="search" class="rounded-lg px-2  py-2 w-full border">
                </div>
                @if(Auth::user()->role_id>1)
                <x-button class="flex items-center p-2 mb-3 rounded-lg text-white bg-pink-800 hover:bg-pink-900" wire:click="adduserfun">

                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Add New User
                </x-button>
                @endif

            </div>

            <table class="w-full text-sm text-left text-gray-500">

                <thead class="text-xs text-gray-200 uppercase bg-slate-600">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mobile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            District
                        </th>
                        <th scope="col" class="px-6 py-3">
                            email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->mobile }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->district->name??"NA" }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email??"NA" }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->role->description??"NA"}}
                        </td>
                        <td class="px-3 py-4 text-right">
                            <x-button wire:click="changepwd({{$user->id}})">
                                Change password
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

    <x-confirmation-modal wire:model="cpwd">
        <x-slot name="title">Change Password</x-slot>

        <x-slot name="content">
            
            <form wire:submit.prevent="save">
                @csrf
                <div class="mb-4">
                    <label for="password" class="block font-medium mb-2">Password</label>
                    <input value="{{ old('password') }}" type="password" wire:model="userdata.password" id="password" class="w-full border rounded-lg px-3 py-2">
                    @error('password')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium mb-2">Confirm Password</label>
                    <input value="{{ old('password_confirmation') }}" type="password" wire:model="userdata.password_confirmation" id="password_confirmation" class="w-full border rounded-lg px-3 py-2">
                    @error('password_confirmation')
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-button class="bg-pink-800 mr-2 focus:bg-pink-900 hover:bg-pink-900" type="submit">Save</x-button>
                </div>
            </form>
            {{-- @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="text-orange-400 "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                {{ $error }}
            </div>
            @endforeach
            @endif --}}

        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="toggle('changepwd')">CLose</x-button>
        </x-slot>

    </x-confirmation-modal>

    <x-confirmation-modal wire:model="adduser">
        <x-slot name="title">Add New User</x-slot>

        <x-slot name="content">
            @livewire('register-new-user')
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="toggle('adduser')">CLose</x-button>
        </x-slot>

    </x-confirmation-modal>

</div>
