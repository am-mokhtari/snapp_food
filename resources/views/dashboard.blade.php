@php
    use Illuminate\Support\Facades\Auth;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                @php
                    $panel = \Illuminate\Support\Facades\Auth::user()->role;
                @endphp
                <a href="{{ url('dashboard/'.$panel) }}">
                    <button
                        class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500
                         hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Go To Panel
                    </button>
                </a>
            </div>
        </div>
    </div>

    <script src="/js/tailwind-style.js"></script>
</x-app-layout>
