@extends('layouts.app', ['overflow_x' => true, 'hide_nav' => true])

@php
function getPath($img_path)
{
    return Storage::url('property_photos/' . $img_path);
}

$mainPath = $property
    ->photos()
    ->where('is_main', 1)
    ->first()['photo_path'];

$otherImages = $property
    ->photos()
    ->where('is_main', 0)
    ->get();

$rooms = json_decode($property->rooms_details);

$icon = '';

switch ($property->property_selection) {
    case 'apartment':
        $icon = 'building';
        break;
    default:
        $icon = 'house';
        break;
}
@endphp

@section('content')
    <link rel="stylesheet" href="{{ asset('css/propertyShow.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />


    <div class="max-w-4xl mx-auto mt-12">
        <div class="mx-4 text-xl text-gray-800">
            <div class="grid grid-cols-12" id="header">
                <div
                    class="col-span-12 row-start-2 md:col-span-5 md:row-start-1 md:row-end-3 flex justify-center items-center">
                    <img class="w-full rounded-sm object-cover" src="{{ getPath($mainPath) }}" alt="Main property photo">
                </div>
                <div class="col-span-12 row-start-1 md:col-span-7">
                    <div class="flex justify-between items-center">
                        <h1 class="font-semibold text-2xl py-2 md:px-5">
                            <span>
                                <i class="fa-solid fa-{{ $icon }}-user"></i>
                            </span>
                            {{ ucfirst($property->property_name) }}
                        </h1>
                        <div class="text-gray-800 font-semibold text-lg">
                            <i class="fa-solid fa-euro-sign"></i>
                            {{ $property->price }} / per night
                        </div>
                    </div>
                </div>
                <div class="col-span-12 self-end md:col-span-7 md:row-start-2 mt-5 text-xl text-gray-800">
                    <div class="check-in-out py-3 md:!py-0 md:px-5 grid gap-2">
                        <div class="check-in flex items-center py-1">
                            <i class="fa-solid fa-people-roof"></i>
                            <div>
                                <p class="px-2 text-base " style="vertical-align: end">Max people <span
                                        class="font-semibold">{{ $property->max_people }}</span></p>
                            </div>
                        </div>
                        <div>
                            <div class="check-in flex items-center py-1">
                                <i class="fa-solid fa-{{ $icon }}-circle-check text-green-600"></i>
                                <p class="px-2 text-base">Check in from <span
                                        class="font-semibold">{{ $property->check_in }}</span></p>
                            </div>
                            <div class="check-out flex items-center py-1">
                                <i class="fa-solid fa-{{ $icon }}-circle-xmark text-red-500"></i>
                                <p class="px-2 text-base">Check out on <span
                                        class="font-semibold">{{ $property->check_out }}</span></p>
                            </div>
                        </div>
                        {{-- <div class="check-in py-1">
                            <div class="flex items-center">
                                <i class="fa-solid fa-bed"></i>
                                <p class="px-2 text-lg">Bedrooms <span class="font-semibold">{{ $rooms->bedroom }}</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-bed"></i>
                                <p class="px-2 text-lg">Bedrooms <span class="font-semibold">{{ $rooms->bedroom }}</span>
                                </p>
                            </div>
                            <div class="flex items-center">
                                <i class="fa-solid fa-bed"></i>
                                <p class="px-2 text-lg">Bedrooms <span class="font-semibold">{{ $rooms->bedroom }}</span>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div x-data="tabs" x-init="addTabs([{ name: 'images', icon: 'fa-image', title: 'Images', el: 'images-tab' }, { name: 'location', icon: 'fa-location-dot', title: 'Location', el: 'location-tab' }, { name: 'room-details', icon: 'fa-circle-info', title: 'Rooms', el: 'room-details-tab' }], 'images')">
                <div id="main-tab-container">
                </div>

                <div id="tabs">
                    <div id="images-tab" class="mt-5 tab-slide">
                        {{-- <h1 class="font-semibold">Images</h1> --}}
                        <div class="relative">
                            <div class="property-swiper mt-3 overflow-hidden relative">
                                <div class="swiper-wrapper">
                                    @foreach ($otherImages as $image)
                                        <div class="swiper-slide h-auto ">
                                            <img class="rounded-sm h-full w-full object-center"
                                                src="{{ getPath($image->photo_path) }}" alt="Property Image">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="property-pagination flex justify-center items-center mt-4"></div>
                            </div>
                            <div
                                class="swiper-button-next hidden border border-gray-400 lg:flex bg-white py-0 px-4 rounded">
                                <i class="fa-solid fa-arrow-right text-gray-800"></i></i>
                            </div>
                            <div
                                class="swiper-button-prev hidden border border-gray-400 lg:flex bg-gray-100 py-0 px-4 rounded">
                                <i class="fa-solid fa-arrow-left text-gray-800"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Map Location --}}
                    @php
                        $current_location = json_decode($property->current_location);
                        $marker_location = json_decode($property->marker_location);
                        $useMarker = null;
                        
                        if (isset($marker_location->lat)) {
                            $useMarker = $marker_location;
                        } else {
                            $useMarker = $current_location;
                        }
                    @endphp
                    <div class="mt-5 tab-slide invisible" id="location-tab">
                        <div class="mt-3 relative">
                            <div id="map" class="h-64 w-full"></div>
                            <div id="relocate" class="absolute bottom-6 bg-white p-2 rounded border border-gray-300 z-999">
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </div>
                        </div>
                    </div>
                    {{-- Room details --}}
                    <div class="mt-5 tab-slide" id="room-details-tab">
                        <div class="mt-3 relative">
                            <div class="bg-gray-100 md:flex items-center justify-center">
                                <div
                                    class="grid grid-cols-12 gap-10 md:gap-2 py-3 md:py-0 border border-gray-200 md:flex-grow md:grid-cols-none md:flex items-center justify-center">
                                    <i class="fa-solid fa-couch text-xl col-start-2 col-end-3"></i>
                                    <p class="col-span-10">
                                        {{ $rooms->livingRoom > 0 ? $rooms->livingRoom . ' Living room' . ($rooms->livingRoom > 1 ? 's' : '') : 'No living room' }}
                                    </p>
                                </div>

                                <div
                                    class="grid grid-cols-12 gap-10 md:gap-2 py-3 md:py-0 border border-gray-200 md:flex flex-grow md:items-center justify-center">
                                    <i class="fa-solid fa-bed col-start-2 col-end-3"></i>
                                    <p class="col-span-10">
                                        {{ $rooms->bedroom > 0 ? $rooms->bedroom . ' Bedroom' . ($rooms->bedroom > 1 ? 's' : '') : 'No bedrooms' }}
                                    </p>
                                </div>

                                <div
                                    class="grid grid-cols-12 gap-10 md:gap-2 py-3 md:py-0 border border-gray-200 md:flex flex-grow md:items-center justify-center">
                                    <i class="fa-solid fa-bath col-start-2 col-end-3 text-2xl"></i>
                                    <p class="col-span-10">
                                        {{ $rooms->bathroom > 0 ? $rooms->bathroom . ' Bathroom' . ($rooms->bathroom > 1 ? 's' : '') : 'No bathrooms' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script>
        const marker_coords = {!! json_encode($useMarker) !!};
    </script>
    <script src="{{ asset('js/PropertyLocationMap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/PropertyImagesSwiper.js') }}"></script>
    <script src="{{ asset('js/Tabs.js') }}"></script>
@endsection
