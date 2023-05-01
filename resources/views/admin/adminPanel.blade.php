@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\RestaurantType;
    use App\Models\FoodCategory;
    use \App\Models\DiscountCode;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('* Admin Panel *') }}
        </h2>
    </x-slot>

    <div class="flex gap-2 m-2">
        {{--    Type Of Restaurant    --}}
        <div class="w-2/4">
            <table class="w-full text-center font-light">
                <thead>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2 text-center" colspan="2">Type Of Restaurant</th>
                    {{--   Create Button   --}}
                    <th scope="col" class="px-2 py-2">
                        <div>
                            <a href="{{ url( 'newRestaurantType') }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-500
   focus:bg-cyan-500 active:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Add a New
                                </button>
                            </a>
                        </div>
                    </th>
                </tr>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2">#</th>
                    <th scope="col" class="px-2 py-2">Title</th>
                    <th scope="col" class="px-2 py-2">Operation</th>
                </tr>
                </thead>
                <tbody>
                @php $counter = 1; @endphp
                @foreach( RestaurantType::all() as $type )
                    <tr class="border-b bg-neutral-100 items-center">
                        <td class="whitespace-nowrap px-2 py-2 font-medium">{{ $counter++ }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $type->title }}</td>
                        <td class="whitespace-nowrap flex justify-center items-center gap-4 px-2 py-2">

                            {{--   Edit Button   --}}
                            <div>
                                <a href="{{ url( 'restaurantTypeEdit/'.$type->id ) }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500
   focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Edit
                                    </button>
                                </a>
                            </div>

                            {{--   Delete Button   --}}
                            <div>
                                <form action="{{ url('restaurantTypeDelete') }}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" value="{{ $type->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600
   focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        {{--    Categories Of Foods    --}}
        <div class="w-2/4">
            <table class="w-full text-center font-light">
                <thead>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2 text-center" colspan="2">Categories Of Foods</th>
                    {{--   Create Button   --}}
                    <th scope="col" class="px-2 py-2">
                        <div>
                            <a href="{{ url( 'newFoodCategory') }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-500
   focus:bg-cyan-500 active:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Add a New
                                </button>
                            </a>
                        </div>
                    </th>
                </tr>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2">#</th>
                    <th scope="col" class="px-2 py-2">Title</th>
                    <th scope="col" class="px-2 py-2">Operation</th>
                </tr>
                </thead>
                <tbody>
                @php $counter = 1; @endphp
                @foreach( FoodCategory::all() as $category )
                    <tr class="border-b bg-neutral-100">
                        <td class="whitespace-nowrap px-2 py-2 font-medium">{{ $counter++ }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $category->title }}</td>
                        <td class="whitespace-nowrap flex justify-center items-center gap-4 px-2 py-2">

                            {{--   Edit Button   --}}
                            <div>
                                <a href="{{ url( 'foodCategoryEdit/'.$category->id ) }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500
   focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Edit
                                    </button>
                                </a>
                            </div>

                            {{--   Create Button   --}}
                            <div>
                                <form action="{{ url('foodCategoryDelete') }}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" value="{{ $category->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600
   focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{--    Discounts Table    --}}
    <div class="flex gap-2 m-2">
        <div class="w-full">
            <table class="w-full text-center font-light">
                <thead>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2 text-center" colspan="4">Discount Codes</th>
                    {{--   Create Button   --}}
                    <th scope="col" colspan="2" class="px-2 py-2">
                        <div>
                            <a href="{{ url('newDiscount') }}">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-cyan-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-500
   focus:bg-cyan-500 active:bg-cyan-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Add a New
                                </button>
                            </a>
                        </div>
                    </th>
                </tr>
                <tr class="border-b bg-gray-400 font-medium">
                    <th scope="col" class="px-2 py-2">#</th>
                    <th scope="col" class="px-2 py-2">Code</th>
                    <th scope="col" class="px-2 py-2">Percents</th>
                    <th scope="col" class="px-2 py-2">Expiration Date</th>
                    <th scope="col" class="px-2 py-2">Expiration Time</th>
                    <th scope="col" class="px-2 py-2">Operation</th>
                </tr>
                </thead>
                <tbody>
                @php $counter = 1; @endphp
                @foreach(DiscountCode::all() as $discount)
                    <tr class="border-b bg-neutral-100">
                        <td class="whitespace-nowrap px-2 py-2 font-medium">{{ $counter++ }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $discount->code }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $discount->percents }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $discount->expiration_date }}</td>
                        <td class="whitespace-nowrap px-2 py-2">{{ $discount->expiration_time }}</td>
                        <td class="whitespace-nowrap flex justify-center items-center gap-4 px-2 py-2">

                            {{--   Edit Button   --}}
                            <div>
                                <a href="{{ url( 'discountCodeEdit/'.$discount->id ) }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500
   focus:bg-yellow-500 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">Edit
                                    </button>
                                </a>
                            </div>

                            {{--   Create Button   --}}
                            <div>
                                <form action="{{ url('discountCodeDelete') }}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" value="{{ $discount->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600
   focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="/js/tailwind-style.js"></script>
</x-app-layout>
