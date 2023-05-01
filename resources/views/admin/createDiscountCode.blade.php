@php
    use \App\Models\DiscountCode;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('* Add New Discount Code *') }}
        </h2>
    </x-slot>

    <div class="flex items-center">
        <form class="w-3/4 flex justify-center items-center" action="{{ url('newDiscount') }}" method="post">
            @csrf
            <div class="flex items-center border-b border-teal-500 py-2 w-3/4">
                <input name="code"
                       class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       type="text" placeholder="Code" aria-label="Full name">

                <input type="number" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       name="percents" placeholder="Percents">

                <input type="date" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       name="expDate" placeholder="Expiration Date">

                <input type="time" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                       name="expTime" placeholder="Expiration Time">

                <button type="submit"
                        class="flex-shrink-0 uppercase bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                    Add
                </button>
            </div>
        </form>

        <a href="{{ redirect()->back()->getTargetUrl() }} ">
            <button
                class="flex-shrink-0 border-transparent uppercase border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded"
                type="button">
                Cancel
            </button>
        </a>
    </div>

    <script src="/js/tailwind-style.js"></script>
</x-app-layout>
