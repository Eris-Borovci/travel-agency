{{-- Main Header Menu --}}

<nav class=" border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <a href="/" class="flex items-center">
          <img src="{{ asset("images/travel_agency_logo.webp") }}" class="mr-3 h-6 sm:h-9 rounded-full" alt="Flowbite Logo">
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Travel Agency</span>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-white rounded-lg md:hidden hover:border-white focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
                <li>
                    <a class="block py-2 pr-4 pl-3 text-white rounded md:border-0 md:p-0 md:dark:hover:bg-transparent" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li>
                    <a class="block py-2 pr-4 pl-3 text-white rounded md:border-0 md:p-0 md:dark:hover:bg-transparent" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
         @else
            <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
          @endguest
          <li class="my-1 block md:hidden">
            <a href="/" class="flex items-center p-1 px-2 rounded-lg border border-transparent hover:border-white {{ Request::is("/") ? 'border-white' : '' }}">
              <svg class="h-8 w-8 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />  <circle cx="7" cy="10" r="1" /></svg>
              <p class="pl-1">Stays</p>
            </a>
          </li>
          <li class="my-1 block md:hidden">
            <a href="/rentals" class="flex items-center rounded-lg p-1 px-2 border border-transparent hover:border-white {{ Request::is("rentals") ? 'border-white' : '' }}">
              <svg class="h-8 w-8 color-white font-normal"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="7" cy="17" r="2" />  <circle cx="17" cy="17" r="2" />  <path d="M5 17h-2v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" /></svg>
              <p class="pl-1 font-normal">Car rentals</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  {{-- Second Menu --}}
  <nav class=" border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900 hidden md:block">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
          <li>
            <a href="/" class="flex items-center p-1 px-2 rounded-lg border border-transparent hover:border-white {{ Request::is("/") ? 'border-white' : '' }}">
              <svg class="h-8 w-8 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />  <circle cx="7" cy="10" r="1" /></svg>
              <p class="pl-1">Stays</p>
            </a>
          </li>
          <li class="pl-4">
            <a href="/rentals" class="flex items-center rounded-lg p-1 px-2 border border-transparent hover:border-white {{ Request::is("rentals") ? 'border-white' : '' }}">
              <svg class="h-8 w-8 color-white font-normal"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="7" cy="17" r="2" />  <circle cx="17" cy="17" r="2" />  <path d="M5 17h-2v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" /></svg>
              <p class="pl-1 font-normal">Car rentals</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>