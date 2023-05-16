@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\RestaurantType;
    use App\Models\FoodCategory;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('* Seller Panel *') }}
        </h2>
    </x-slot>



    <script src="/js/tailwind-style.js"></script>
</x-app-layout>
