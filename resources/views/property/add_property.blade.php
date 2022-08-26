@extends('layouts.app', ['hide_nav' => true, 'overflow_x' => true])

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <div class="mx-auto mt-12">
        <div x-data="property" x-init="initialize">
            <div class="max-w-4xl mx-auto bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                <div :class="slides == maxSlides && 'bg-green-600'"
                    class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500 transition-all"
                    :style="{ width: getProgress() }">
                </div>
            </div>
            <h1 x-show="slides < 1 ? true : false"
                class="text-gray-700 max-w-4xl mx-auto text-2xl text-center md:text-start font-medium">List your property
            </h1>
            <div class="max-w-4xl mx-auto">
                <div :class="slides > 0 && slides != 8 ? '!visible' : 'invisible'" @click="prevSlide"
                    class="cursor-pointer my-2 hover:bg-gray-200 p-1 inline-block rounded-md" style="visibility: hidden">
                    <svg class="h-8 w-8 text-gray-700" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                    </svg>
                </div>
            </div>
            <div class="property">
                <div class="swiper-wrapper">
                    <div class="properties flex my-7 flex-wrap md:flex-nowrap swiper-slide">
                        <div class="flex my-7 flex-wrap md:!flex-nowrap px-3 max-w-4xl mx-auto">
                            {{-- Apartment --}}
                            <div class="flex flex-grow w-full md:flex-col bg-white p-2 shadow-md md:mx-3">
                                <div class="p-3 flex-1 md:self-center">
                                    <img src="{{ asset('images/apartment.png') }}" alt="apartment icon">
                                </div>
                                <div class="flex-[3] flex flex-col justify-start md:text-center">
                                    <h1 class="font-bold">Apartment</h1>
                                    <p class="text-sm">Furnished and self-catering accommodations where guests rent the
                                        entire place.</p>
                                </div>
                                <div class="flex-1 flex justify-end items-center md:justify-center pr-4 md:mt-4 md:pr-0">
                                    <button type="button" @click="nextSlide('apartment')"
                                        class="text-blue-600 md:text-white md:font-semibold md:bg-blue-600 md:p-2 rounded-sm w-full text-center">
                                        <div class="md:hidden">
                                            <i class="fa-solid fa-angle-right text-4xl"></i>
                                        </div>
                                        <div class="hidden md:block">
                                            List your property
                                        </div>
                                    </button>
                                </div>
                            </div>
                            {{-- Home --}}
                            <div class="flex flex-grow md:flex-col w-full bg-white p-2 shadow-md md:mx-3 mt-3 md:mt-0">
                                <div class="p-3 flex-1 md:self-center">
                                    <img src="{{ asset('images/home.png') }}" alt="apartment icon">
                                </div>
                                <div class="flex-[3] flex flex-col justify-start md:text-center">
                                    <h1 class="font-bold">Home</h1>
                                    <p class="text-sm">Properties like apartments, vacation homes, villas, etc.</p>
                                </div>
                                <div class="flex-1 flex justify-end items-center md:justify-center pr-4 md:pr-0 md:mt-4">
                                    <button type="button" @click="nextSlide('home')"
                                        class="text-blue-600 md:text-white md:font-semibold md:bg-blue-600 md:p-2 rounded-sm w-full text-center">
                                        <div class="md:hidden">
                                            <i class="fa-solid fa-angle-right text-4xl"></i>
                                        </div>
                                        <div class="hidden md:block">
                                            List your property
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Property Name --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">What's your property name?</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div>
                                    <label for="property_name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Property
                                        name</label>
                                    <input type="text" name="property_name" x-model="propertyName" id="property_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="" required>
                                </div>
                            </div>
                            <x-divider />
                            <button :disabled="validateFields(propertyName)"
                                :class="validateFields(propertyName) ? 'bg-gray-500' : ''"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="validateSlide(propertyName)">Continue</button>
                        </div>
                    </div>
                    {{-- Property Location --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-xl text-gray-800">Where is your property located?</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <label for="property_location"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Property
                                    location</label>
                                <div class="autocomplete h-full w-full p-1 relative">
                                    <div class="flex absolute top-4 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <circle cx="10" cy="10" r="7" />
                                            <line x1="21" y1="21" x2="15" y2="15" />
                                        </svg>
                                    </div>
                                    <input id="myInput" type="text" x-model="theLocation" x-ref="theLocation"
                                        name="myCountry" placeholder="Location"
                                        class="w-full p-2.5 pl-10 rounded-sm h-full border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                    <h1 x-show="currentLocation == null" class="text-red-600 mt-2">Please enter a valid
                                        location</h1>
                                </div>
                            </div>
                            <x-divider />
                            <button :class="!isLocationValid ? 'bg-gray-500' : ''" :disabled="!isLocationValid"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="validateLocation(true)">Continue</button>
                        </div>
                    </div>
                    {{-- Location Marker --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">Mark your property location</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <label for="map"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select your
                                    location</label>
                                <div id="map" class="h-80 w-full"></div>
                            </div>
                            <x-divider />
                            <button class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="nextSlide()">Continue</button>
                        </div>
                        <input type="hidden" value="20" x-ref="lat" id="lat">
                        <input type="hidden" value="20" x-ref="lon" id="lon">
                    </div>
                    {{-- Property Details --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">Property Details</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Enter
                                        room's amount (you should have at least one room)</label>
                                    <div>
                                        <div class="shadow-md p-4 mt-2 bg-gray-50 flex items-center justify-between">
                                            <h1>Bedroom</h1>
                                            <div class="flex items-center">
                                                <button @click="increaseRoom('bedroom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-plus text-gray-700"></i></button>
                                                <h1 class="px-2" x-text="roomsAmount.bedroom">0</h1>
                                                <button @click="decreaseRoom('bedroom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-minus text-gray-700"></i></button>
                                            </div>
                                        </div>
                                        <div class="shadow-md p-4 mt-4 bg-gray-50 flex items-center justify-between">
                                            <h1>Living room</h1>
                                            <div class="flex items-center">
                                                <button @click="increaseRoom('livingRoom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-plus text-gray-700"></i></button>
                                                <h1 class="px-2" x-text="roomsAmount.livingRoom">0</h1>
                                                <button @click="decreaseRoom('livingRoom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-minus text-gray-700"></i></button>
                                            </div>
                                        </div>
                                        <div class="shadow-md p-4 mt-4 bg-gray-50 flex items-center justify-between">
                                            <h1>Bathroom</h1>
                                            <div class="flex items-center">
                                                <button @click="increaseRoom('bathroom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-plus text-gray-700"></i></button>
                                                <h1 class="px-2" x-text="roomsAmount.bathroom">0</h1>
                                                <button @click="decreaseRoom('bathroom')"
                                                    class="py-1 px-3 hover:bg-gray-200 rounded-lg"><i
                                                        class="fa-solid fa-minus text-gray-700"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-divider />
                            <button :disabled="!validateRooms()" :class="!validateRooms() ? '!bg-gray-500' : ''"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="validateRooms(true)">Continue</button>
                        </div>
                    </div>
                    {{-- Property Check-in --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">From which date you accept check in/out</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div>
                                    <label for="datepicker"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select
                                        date</label>
                                    <div>
                                        <div date-rangepicker="" class="flex items-center justify-center">
                                            <div class="relative">
                                                <div
                                                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true"
                                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <input x-ref="checkIn" autocomplete="off" name="start" type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                                                    placeholder="Select date start">
                                            </div>
                                            <span class="mx-4 text-gray-500">to</span>
                                            <div class="relative">
                                                <div
                                                    class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true"
                                                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <input x-ref="checkOut" autocomplete="off" name="end" type="text"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                                                    placeholder="Select date end">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <x-divider />
                                <button :disabled="!validateCheckInOut()"
                                    :class="!validateCheckInOut() ? 'bg-gray-500' : ''"
                                    class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                    @click="validateCheckInOut(true)">Continue</button>
                            </div>
                        </div>
                    </div>
                    {{-- Property Photos --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">What does your place look like?</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div>
                                    <label for="photos"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Insert at
                                        least one
                                        photo</label>
                                    <div class="my-3 filesGroup">
                                    </div>
                                    <div class="flex justify-end">
                                        <button class="bg-gray-200 px-3 py-2 rounded-lg hover:bg-gray-300 transition-all"
                                            type="button" @click="addFileInput()" x-ref="addFileBtn"><i
                                                class="fa-solid fa-plus text-gray-700 hover:text-gray-900 transition-all"></i></button>
                                    </div>
                                </div>
                            </div>
                            <x-divider />
                            <button :disabled="!selectedFiles.length > 0"
                                :class="!selectedFiles.length > 0 && '!bg-gray-500'"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="checkFiles(true)">Continue</button>
                        </div>
                    </div>
                    {{-- Property Price --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl">How much do you want to charge per night?</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div>
                                    <label for="property_name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Price
                                        guests pay</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                            <i class="fa-solid fa-euro-sign text-gray-600"></i>
                                        </span>
                                        <input type="number" x-model="price"
                                            class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                            placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <x-divider />
                            <button :disabled="price == 0" :class="price == 0 ? '!bg-gray-500' : ''"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="sendRequest(true)">Finish</button>
                        </div>
                    </div>
                    {{-- Finished --}}
                    <div class="swiper-slide px-1 md:px-3">
                        <div class="max-w-xl mx-auto">
                            <h1 class="font-semibold text-gray-800 text-xl text-center">Finished</h1>
                            <div class="bg-white py-5 px-8 mt-8 rounded">
                                <div class="flex justify-center">
                                    <video height="200" width="200" id="finished_animation">
                                        <source src="{{ asset('videos/4964-check-mark-success-animation.mp4') }}"
                                            type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <x-divider />
                            <div class="flex text-center">
                                <a href="/partner" class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                    @click="redirect()">Finish</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
            integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
            crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/CitiesItem.js') }}"></script>
        <script src="{{ asset('js/ActivityIndicator.js') }}"></script>
        <script src="{{ asset('js/SearchCities.js') }}"></script>
        <script src="{{ asset('js/autocomplete.js') }}"></script>
        <script src="{{ asset('js/AddPropertySwiper.js') }}"></script>
        <script src="{{ asset('js/AddPropertyAlpine.js') }}"></script>
    @endsection
