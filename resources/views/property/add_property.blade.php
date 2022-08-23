@extends('layouts.app', ['hide_nav' => true, 'overflow_x' => true])

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <div class="mx-auto mt-12">
        <div x-data="property" x-init="initialize">
            <div class="max-w-4xl mx-auto bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500 transition-all"
                    :style="{ width: getProgress() }"></div>
            </div>
            <h1 x-show="slides < 1 ? true : false"
                class="text-gray-700 max-w-4xl mx-auto text-2xl text-center md:text-start font-medium">List your property
            </h1>
            <div class="max-w-4xl mx-auto">
                <div :class="slides > 0 ? '!visible' : 'invisible'" @click="prevSlide"
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
                        <div class="flex my-7 flex-wrap md:flex-nowrap px-3 max-w-4xl mx-auto">
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
                                @click="nextSlide">Continue</button>
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
                                        room's amount</label>
                                    <div>
                                        <div>Bedroom</div>
                                        <div>Living room</div>
                                        <div>Bathroom</div>
                                    </div>
                                </div>
                            </div>
                            <x-divider />
                            <button :disabled="validateFields(propertyName)"
                                :class="validateFields(propertyName) ? 'bg-gray-500' : ''"
                                class="bg-blue-800 text-white w-full px-2 py-3 rounded"
                                @click="validateSlide(propertyName)">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/CitiesItem.js') }}"></script>
    <script src="{{ asset('js/ActivityIndicator.js') }}"></script>
    <script src="{{ asset('js/SearchCities.js') }}"></script>
    <script src="{{ asset('js/autocomplete.js') }}"></script>
    <script src="{{ asset('js/AddPropertySwiper.js') }}"></script>
    <script src="{{ asset('js/AddPropertyAlpine.js') }}"></script>
@endsection
