@php
    use Illuminate\Support\Facades\Auth;
    use \App\Models\RestaurantType;
    use \App\Models\FoodCategory;
@endphp

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
    {{ __('* Admin Panel *') }}

    <a href="{{ url('dashboard') }}">
        <button
            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500
                         hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
            type="button">
            Go To Dashboard
        </button>
    </a>
</h2>

<div class="flex flex-col mx-8">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead>
                    <tr class="border-b bg-gray-400 font-medium">
                        <th scope="col" class="px-6 py-4 text-center" colspan="2">Type Of Restaurant</th>
                        {{--   Create Button   --}}
                        <th scope="col" class="px-6 py-4">
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
                        <th scope="col" class="px-6 py-4">#</th>
                        <th scope="col" class="px-6 py-4">Title</th>
                        <th scope="col" class="px-6 py-4">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $counter = 1; @endphp
                    @foreach( RestaurantType::all() as $type )
                        <tr class="border-b bg-neutral-100 ">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $counter++ }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $type->title }}</td>
                            <td class="whitespace-nowrap flex gap-4 px-6 py-4">

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
        </div>
    </div>
</div>


<div class="flex flex-col mx-8">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead>
                    <tr class="border-b bg-gray-400 font-medium">
                        <th scope="col" class="px-6 py-4 text-center" colspan="2">Categories Of Foods</th>
                        {{--   Create Button   --}}
                        <th scope="col" class="px-6 py-4">
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
                        <th scope="col" class="px-6 py-4">#</th>
                        <th scope="col" class="px-6 py-4">Title</th>
                        <th scope="col" class="px-6 py-4">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $counter = 1; @endphp
                    @foreach( FoodCategory::all() as $category )
                        <tr class="border-b bg-neutral-100 ">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $counter++ }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $category->title }}</td>
                            <td class="whitespace-nowrap flex gap-4 px-6 py-4">

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
    </div>
</div>

<script src="/js/tailwind-style.js"></script>
</body>
</html>

