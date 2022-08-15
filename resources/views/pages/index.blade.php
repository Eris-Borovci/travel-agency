@extends("layouts.app")

@section("content")
    <link rel="stylesheet" href="{{ asset("css/autocomplete.css") }}">
    {{-- The Header --}}
    <div class="py-16 bg-blue-800 text-white">
        <div class="container mx-auto">
        <h1 class="font-bold text-5xl">Find your next stay</h1>
        <p class="text-xl py-2">Search deals on hotels, homes etc...</p>
        </div>
    </div>
    {{-- Search Form --}}
    <div class="container mx-auto block md:flex h-14 mt-[-1.75rem] justify-center">
      <form autocomplete="off" action="/action_page.php" class="block mx-3 md:flex bg-secondary items-center justify-center rounded-sm">
        {{-- Input on Country search  --}}
        <div class="autocomplete h-full w-full md:w-72 p-1">
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="10" cy="10" r="7" />  <line x1="21" y1="21" x2="15" y2="15" /></svg>
          </div>
          <input id="myInput" type="text" name="myCountry" placeholder="Location" class="p-2.5 pl-10 rounded-sm h-full border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
        </div>
        {{-- Date picker "from - to" --}}
        <div date-rangepicker class="flex flex-wrap md:flex-nowrap items-center h-full px-1 md:px-0 justify-center py-1">
          <div class="relative h-full flex-shrink w-full md:w-auto md:pr-1">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="start" type="text" class="h-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date start">
          </div>
          <div class="relative h-full flex-shrink w-full md:w-auto">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="end" type="text" class="h-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input" placeholder="Select date end">
        </div>
        </div>
        {{-- Counter --}}
        <div class="relative h-full p-1">
          <div class="flex absolute h-full inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="h-5 w-5 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>            
          </div>
          <input type="number" id="visitors" placeholder="People" class="h-full bg-[#f1f1f1] border border-gray-300 text-gray-900 sm:text-sm focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
        </div>
        <div class="flex justify-center pb-1 px-1 md:px-0 md:pr-1 md:py-1 h-full">
          <button type="submit" class="bg-blue-700 h-full w-full text-white px-5 py-2 rounded-sm md:rounded-r-md">Search</button>
        </div>
      </form>
    </div>

    <script src="{{ asset("js/CitiesItem.js") }}"></script>
    <script src="{{ asset("js/ActivityIndicator.js") }}"></script>
    <script src="{{ asset("js/SearchCities.js") }}"></script>
    <script src="{{ asset("js/autocomplete.js") }}"></script>
@endsection