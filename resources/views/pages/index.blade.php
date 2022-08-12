@extends("layouts.app")

@section("content")
    <link rel="stylesheet" href="{{ asset("css/autocomplete.css") }}">
    {{-- The Header --}}
    <div class="py-16 bg-primary text-white">
        <div class="container mx-auto">
        <h1 class="font-bold text-5xl">Find your next stay</h1>
        <p class="text-xl py-2">Search deals on hotels, homes etc...</p>
        </div>
    </div>
    {{-- Search Form --}}
    <div class="container mx-auto block md:flex h-12 mt-[-1.5rem] justify-center">
      <form autocomplete="off" action="/action_page.php" class="block md:flexbg-gray-300 items-center justify-center rounded-lg">
        {{-- Input on Country search  --}}
        <div class="autocomplete h-full w-72">
          <input id="myInput" type="text" name="myCountry" placeholder="Location" class="rounded-l-md h-full border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>
        {{-- Date picker "from - to" --}}
        <div date-rangepicker class="flex items-center h-full">
          <div class="relative h-full">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="start" type="text" class="h-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date start">
          </div>
          <span class="mx-2 text-gray-500">to</span>
          <div class="relative h-full">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="end" type="text" class="h-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date end">
        </div>
        </div>
        <button type="submit" class="bg-blue-700 text-white px-5 h-full rounded-r-md">Search</button>
      </form>
    </div>

    <script src="{{ asset("js/CitiesItem.js") }}"></script>
    <script src="{{ asset("js/ActivityIndicator.js") }}"></script>
    <script src="{{ asset("js/SearchCities.js") }}"></script>
    <script src="{{ asset("js/autocomplete.js") }}"></script>
@endsection