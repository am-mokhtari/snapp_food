@php
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
    {{ __('* Add New Food Category *') }}
</h2>

<div class="flex justify-center items-center">
    <form class="w-full max-w-sm" action="{{ url('newFoodCategory') }}" method="post">
        @csrf
        <div class="flex items-center border-b border-teal-500 py-2">
            <input name="title"
                   class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                   type="text" placeholder="Title" aria-label="Full name">

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
</body>
</html>
