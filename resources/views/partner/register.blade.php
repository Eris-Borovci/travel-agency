@extends("home", ['hide_nav' => true, "overflow" => true])

@section("content")
    @livewireStyles
    <div class="container mx-auto mt-12 w-sm max-w-sm flex justify-center">
        <div class="text-gray-700">
            <livewire:register-partner>
        </div>
    </div>
    @livewireScripts
@endsection