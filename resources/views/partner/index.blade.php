@extends("layouts.app", ['hide_nav' => true])

@section('content')
    <div>
        <div class="max-w-4xl mx-auto mt-12">
            <div class="mx-3">
                <div class="flex justify-between mt-3">
                    <h1 class="text-2xl text-center md:text-start font-medium text-gray-800">My properties</h1>
                    <a href="/property/create" class="text-blue-600 border border-blue-600 py-2 px-4 rounded hover:bg-blue-600 hover:text-white transition">Add property</a>
                </div>
                <div class="properties my-7">
                    <x-property image="http://travel-agency.test/images/prop-img.jpg" title="New property" />
                </div>
            </div>
        </div>
    </div>
@endsection