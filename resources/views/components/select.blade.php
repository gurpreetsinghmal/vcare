@props(['disabled' => false])


<div class="border bg-white py-1 {{$disabled?'border-gray-400 border-dashed':'border-purple-100'}} mt-1">

    <select class="border-0 focus:ring-0 w-full form-select" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-gray-500 focus:border-purple-100 focus:ring focus:ring-purple-100 focus:ring-opacity-50 rounded-sm shadow-sm']) !!}>


        <option value="0">Select Option</option>

        @foreach ($list as $item)

        <option class="border-0 border-purple-100 leading-loose" value={{$item['id']}}>{{$item['name']}}</option>

        @endforeach

    </select>

</div>
