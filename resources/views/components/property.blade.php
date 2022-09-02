<div class="flex flex-col md:flex-row bg-white border-2 border-gray-100 md:max-h-44 justify-start my-4">
    <div class="flex-1 flex items-center justify-start">
        <img src="{{ $image }}" alt="image" class="w-full h-auto md:w-auto md:h-full">
    </div>
    <div class="py-2 px-4 flex flex-col flex-[2] justify-around">
        <h1 class="font-medium text-xl py-3">{{ $title }}</h1>
        <a href="{{ $redirect }}" class="bg-blue-600 text-center rounded-sm text-white px-4 py-2 mt-3">Visit</a>
    </div>
</div>
