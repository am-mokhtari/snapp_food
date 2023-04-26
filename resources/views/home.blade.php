@include("layouts.header_footer.header")
{{--@if (Route::has('login'))--}}
{{--        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/dashboard') }}"--}}
{{--                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}"--}}
{{--                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log--}}
{{--                    in</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}"--}}
{{--                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}

    <p class="text-center">
        Welcome to our Karvash
        @auth
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        @endif
    </p>
    <div class="flex justify-center">
            @if( \Illuminate\Support\Facades\Auth::check() )
                <a href=" {{ route('dashboard') }} ">
                    <x-simple-button>Go To Dashboard</x-simple-button>
                </a>
            @else
                <a href=" {{ route('login') }} ">
                    <x-simple-button>Login...</x-simple-button>
                </a>
            @endif

    </div>

@include("layouts.header_footer.footer")
