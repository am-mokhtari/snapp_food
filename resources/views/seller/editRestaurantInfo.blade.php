@php
    use \App\Models\Restaurant;
    use \App\Models\RestaurantType;

    $info = Restaurant::find($id);
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('* Restaurant Info *') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center">
        <form class="flex flex-col justify-center items-center w-full max-w-sm" action="{{'/restaurant/'.$id.'/info'}}"
              method="post">
            @csrf
            <input name="name"
                   class="bg-transparent w-full text-gray-700 p-2 my-2 leading-tight focus:outline-none border-0 border-b border-teal-500"
                   type="text" placeholder="Restaurant Name" value="{{ $info->name ?? null }}">

            <select name="type_id"
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700
                     py-3 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                @foreach(RestaurantType::all() as $type)
                    <option class="" value="{{ $type->id }}">
                        {{ $type->title }}
                    </option>
                @endforeach
            </select>

            <input name="phone_number"
                   class="bg-transparent w-full text-gray-700 p-2 my-2 leading-tight focus:outline-none border-0 border-b border-teal-500"
                   type="text" placeholder="Phone Number" value="{{ $info->phone_number ?? null }}">

            <input name="address"
                   class="bg-transparent w-full text-gray-700 p-2 my-2 leading-tight focus:outline-none border-0 border-b border-teal-500"
                   type="text" placeholder="Address" value="{{ $info->address ?? null }}">

            <input name="accountNumber"
                   class="bg-transparent w-full text-gray-700 p-2 my-2 leading-tight focus:outline-none border-0 border-b border-teal-500"
                   type="text" placeholder="Account Number" value="{{ $info->account_number ?? null }}">

            <div class="flex justify-end w-full">
                <div class="bg-teal-100 rounded w-fit">
                    <a href="{{ redirect()->back()->getTargetUrl() }} ">
                        <button
                            class="flex-shrink-0 border-transparent uppercase border-4 text-teal-600 hover:text-teal-800 text-sm py-1 px-2 rounded"
                            type="button">
                            Cancel
                        </button>
                    </a>
                    <button type="submit"
                            class="flex-shrink-0 uppercase bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                            type="button">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
