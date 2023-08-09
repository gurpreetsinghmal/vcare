<div>


    <form method="post" wire:submit.prevent="register">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium mb-2">Name</label>
            <input value="{{ old('name') }}" type="text" wire:model="user.name" id="user.name" class="w-full border rounded-lg px-3 py-2">
            @error('name')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium mb-2">Mobile</label>
            <input value="{{ old('mobile') }}" maxlength="10" type="text" wire:model="user.mobile" id="name" class="w-full border rounded-lg px-3 py-2">
            @error('mobile')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium mb-2">Email</label>
            <input value="{{ old('email') }}" type="email" wire:model="user.email" id="email" class="w-full border rounded-lg px-3 py-2">
            @error('email')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium mb-2">Password</label>
            <input value="{{ old('password') }}" type="password" wire:model="user.password" id="password" class="w-full border rounded-lg px-3 py-2">
            @error('password')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium mb-2">Confirm Password</label>
            <input value="{{ old('password_confirmation') }}" type="password" wire:model="user.password_confirmation" id="password_confirmation" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium mb-2">District</label>
            {{-- <input value="{{ old('role') }}" type="text" wire:model="role" id="name" class="w-full border rounded-lg px-3 py-2"> --}}

            @if (Auth::user()->role_id==7)
            <select wire:model="user.district_id" id="countries" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5  ">
                <option value="">Choose District</option>
                @foreach ($district_options as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
            @endif
            @if (Auth::user()->role_id<7) <span class="font-extrabold text-lg">{{Auth::user()->district->name}}</span>
                @endif
                @error('district_id')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block font-medium mb-2">Block</label>
            {{-- <input value="{{ old('role') }}" type="text" wire:model="role" id="name" class="w-full border rounded-lg px-3 py-2"> --}}

            @if (Auth::user()->role_id==6)
            <select wire:model="user.block_id" id="countries" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5  ">
                <option value="">Choose Block</option>
                @foreach ($block_options as $b)
                <option value="{{$b->block->id}}">{{$b->block->name}}</option>
                @endforeach
            </select>
            @endif
            @if (Auth::user()->role_id<6 && Auth::user()->role_id>1)
                <span class="font-extrabold text-lg">{{Auth::user()->block->name}}</span>
                @endif

                @error('block_id')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block font-medium mb-2">Role</label>
            {{-- <input value="{{ old('role') }}" type="text" wire:model="role" id="name" class="w-full border rounded-lg px-3 py-2"> --}}

            <select  wire:model="user.role_id" id="countries" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5  ">
                <option value="">Choose Role</option>
                @foreach ($role_options as $r)
                <option class="text-red-700 text-md p-6" value="{{$r->id}}">{{$r->description}}</option>
                @endforeach
            </select>


            @error('role_id')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">

            {{-- <input value="{{ old('role') }}" type="text" wire:model="role" id="name" class="w-full border rounded-lg px-3 py-2"> --}}

            @if (Auth::user()->role_id==2)
            
            <label for="name" class="block font-medium mb-2">Village</label>
            <select  wire:model="user.village_id" id="countries" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-pink-400 focus:border-pink-400 block w-full p-2.5  ">
                <option value="">Choose Village</option>
                @foreach ($village_options as $b)
                <option value="{{$b->village->id}}">{{$b->village->name}}</option>
                @endforeach
            </select>
            @endif

            @if($message)
            <span class="text-red-600">{{$message}}</span>
            @endif
        </div>
       

<div class="mb-4">
    <x-button class="bg-pink-800 mr-2 focus:bg-pink-900 hover:bg-pink-900" type="submit">Create New Account</x-button>
</div>
</form>




</div>
