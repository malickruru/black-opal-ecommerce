@props(['placeholder','val'])
    <form class="flex justify-center" action="" method="GET">
        <input type="search" id="default-search" class="block w-full p-2 pl-15 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 " name='search' placeholder="{{ $placeholder }}" value="{{$val}}"   >
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2 ">@include('svg.search')</a>
    </form>
