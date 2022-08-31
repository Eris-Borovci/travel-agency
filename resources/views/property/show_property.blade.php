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
@endphp

@section('content')
    <style>
        #relocate {
            left: 10px;
        }

        .swiper-button-next {
            right: -40px;
            font-size: 20px;
        }

        .swiper-button-prev {
            left: -40px;
            font-size: 20px;
        }

        .swiper-button-lock {
            opacity: 0.5;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            content: '';
        }
    </style>

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
                    <h1 class="font-semibold text-2xl py-2 md:px-5">
                        <span>
                            @if ($property->property_selection == 'apartment')
                                <i class="fa-solid fa-building-user"></i>
                            @else
                                <i class="fa-solid fa-house-user"></i>
                            @endif
                        </span>
                        {{ ucfirst($property->property_name) }}
                    </h1>
                </div>
                <div class="col-span-12 self-end md:col-span-7 md:row-start-2 mt-5 text-xl text-gray-800">
                    <div class="check-in-out py-3 md:!py-0 md:px-5">
                        @if ($property->property_selection == 'apartment')
                            <div class="check-in flex items-center py-1">
                                <i class="fa-solid fa-building-circle-check text-green-600"></i>
                                <p class="px-2 text-lg">Check in from <span
                                        class="font-semibold">{{ $property->check_in }}</span></p>
                            </div>
                            <div class="check-out flex items-center py-1">
                                <i class="fa-solid fa-building-circle-xmark text-red-500"></i>
                                <p class="px-2 text-lg">Check out on <span
                                        class="font-semibold">{{ $property->check_out }}</span></p>
                            </div>
                        @else
                            <div class="check-in flex items-center py-1">
                                <i class="fa-solid fa-house-circle-check text-green-600"></i>
                                <p class="px-2 text-lg">Check in from <span
                                        class="font-semibold">{{ $property->check_in }}</span></p>
                            </div>
                            <div class="check-out flex items-center py-1">
                                <i class="fa-solid fa-house-circle-xmark text-red-500"></i>
                                <p class="px-2 text-lg">Check out on <span
                                        class="font-semibold">{{ $property->check_out }}</span></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if (count($otherImages) > 0)
                <div id="property-images" class="mt-5">
                    <h1 class="font-semibold">Images</h1>
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
                        <div class="swiper-button-next hidden border border-gray-400 lg:flex bg-white py-0 px-4 rounded"><i
                                class="fa-solid fa-arrow-right text-gray-800"></i></i></div>
                        <div class="swiper-button-prev hidden border border-gray-400 lg:flex bg-gray-100 py-0 px-4 rounded">
                            <i class="fa-solid fa-arrow-left text-gray-800"></i>
                        </div>
                    </div>
                </div>
            @endif
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
            <div class="mt-5">
                <h1 class="font-semibold">Located</h1>
                <div class="mt-3 relative">
                    <div id="map" class="h-64 w-full"></div>
                    <div id="relocate" class="absolute bottom-6 bg-white p-2 rounded border border-gray-300 z-999">
                        <i class="fa-solid fa-location-crosshairs"></i>
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
        if (marker_coords.lon == undefined) {
            marker_coords.lon = marker_coords.lng;
        }

        const map = L.map("map").setView([marker_coords.lat, marker_coords.lon], 10);

        L.tileLayer(
            "https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=ssVRaMfqFIYA1Om5wsEo", {
                attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
            }
        ).addTo(map);

        let marker = L.marker(
            [marker_coords.lat, marker_coords.lon], {
                draggable: false,
            }
        ).addTo(map);

        document.querySelector("#relocate").addEventListener("click", () => {
            map.setView([marker_coords.lat, marker_coords.lon], 17);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const propertySwiper = new Swiper(".property-swiper", {
            slidesPerView: 3,
            slidesPerGroup: 2,
            spaceBetween: 20,
            rewind: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.property-pagination',
            },
            breakpoints: {
                768: {
                    rewind: true
                }
            }
        })
    </script>
@endsection
