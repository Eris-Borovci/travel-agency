@extends("layouts.app", ['hide_nav' => true])

@section("content")
    <div class="max-w-4xl mx-auto mt-12">
        <div class="mx-3">
            <h1 class="text-2xl text-center md:text-start font-medium text-gray-800">List your property</h1>
            <div class="properties flex my-7 flex-wrap md:flex-nowrap">
                {{-- Apartment --}}
                <div class="flex flex-grow w-full md:flex-col bg-white p-2 shadow-md md:mx-3">
                    <div class="p-3 flex-1 md:self-center">
                        <img src="{{ asset("images/apartment.png") }}" alt="apartment icon">
                    </div>
                    <div class="flex-[3] flex flex-col justify-evenly md:text-center">
                        <h1 class="font-bold">Apartment</h1>
                        <p class="text-sm">Furnished and self-catering accommodations where guests rent the entire place.</p>
                    </div>
                    <div class="flex-1 flex justify-end items-center md:justify-center pr-4 md:mt-4 md:pr-0">
                        <a href="/" class="text-blue-600 md:text-white md:font-semibold md:bg-blue-600 md:p-2 rounded-sm w-full text-center">
                            <div class="md:hidden">
                                <i class="fa-solid fa-angle-right text-4xl"></i>
                            </div>
                            <div class="hidden md:block">
                                List your property
                            </div>
                        </a>
                    </div>
                </div>
                {{-- Home --}}
                <div class="flex flex-grow md:flex-col w-full bg-white p-2 shadow-md md:mx-3">
                    <div class="p-3 flex-1 md:self-center">
                        <img src="{{ asset("images/home.png") }}" alt="apartment icon">
                    </div>
                    <div class="flex-[3] flex flex-col justify-evenly md:text-center">
                        <h1 class="font-bold">Home</h1>
                        <p class="text-sm">Properties like apartments, vacation homes, villas, etc.</p>
                    </div>
                    <div class="flex-1 flex justify-end items-center md:justify-center pr-4 md:pr-0 md:mt-4">
                        <a href="/" class="text-blue-600 md:text-white md:font-semibold md:bg-blue-600 md:p-2 rounded-sm w-full text-center">
                            <div class="md:hidden">
                                <i class="fa-solid fa-angle-right text-4xl"></i>
                            </div>
                            <div class="hidden md:block">
                                List your property
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection