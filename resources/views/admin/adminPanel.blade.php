@php
    use Illuminate\Support\Facades\Auth;
    use \App\Models\RestaurantType;
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
</h2>

<div class="flex flex-col mx-8">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full text-left text-sm font-light">
                    <thead>
                    <tr class="border-b bg-gray-400 font-medium">
                        <th scope="col" class="px-6 py-4 text-center" colspan="3">Type Of Restaurant</th>
                    </tr>
                    <tr class="border-b bg-gray-400 font-medium">
                        <th scope="col" class="px-6 py-4">#</th>
                        <th scope="col" class="px-6 py-4">Title</th>
                        <th scope="col" class="px-6 py-4" colspan="1">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $counter = 1; @endphp
                    @foreach( RestaurantType::all() as $type )
                        <tr class="border-b bg-neutral-100 ">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $counter++ }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $type->title }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <form action="{{ route('restaurantTypeDelete') }}" method="post">
                                    @csrf
                                    <input name="id" type="hidden" value="{{ $type->id }}">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent
  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600
   focus:bg-red-600 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 transition ease-in-out duration-150">delete</button>
                                </form>
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

