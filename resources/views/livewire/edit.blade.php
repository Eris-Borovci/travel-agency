<div class="max-w-4xl mx-auto mt-12 bg-white p-3 rounded">
    <div class="flex justify-between items-center">
        <h1 class="px-2 py-4 font-semibold text-xl">Property details</h1>
        <div wire:click="reset_values()" class="flex items-center cursor-pointer">
            <i class="fa-solid fa-retweet text-xl mr-1"></i>
            <h1 class="font-semibold">Reset</h1>
        </div>
    </div>
    <form class="p-2" action="/property/{{ $property->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-6 mb-2 md:grid-cols-2">
            <div>
                <label for="property_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Property name</label>
                <div class="flex items-center justify-center">
                    <input name="property_name" type="text" id="property_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required="" wire:model="property_name" wire:model="property_name">
                </div>
            </div>
            <div>
                <label for="property_selection"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Property
                    selection</label>
                <div class="flex items-center justify-center">
                    <select id="property_selection" name="property_selection"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        wire:model="property_selection">
                        <option value="apartment"
                            {{ $property->property_selection == 'apartment' ? "selected=''" : '' }}>
                            Apartment
                        </option>
                        <option value="home" {{ $property->property_selection == 'home' ? "selected = ''" : '' }}>
                            Home
                        </option>
                    </select>
                </div>

            </div>
            <div>
                <label for="max_people" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Max
                    people</label>
                <div class="flex justify-center items-center">
                    <input type="number" id="max_people" wire:model="max_people" name="max_people"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $property->max_people }}">
                </div>
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"><i
                        class="fa-solid fa-euro-sign text-gray-900 text-sm pr-1"></i>{{ $property->price }}</label>
                <div class="flex justify-center items-center">
                    <input type="number" id="price" wire:model="price" name="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $property->price }}">
                </div>
            </div>
            <div class="w-full col-span-2">
                <label for="date_picker" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Check
                    in/out </label>
                <div date-rangepicker="" id="date_picker" class="w-full grid md:grid-cols-2 gap-6">
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input id="check_in" name="check_in" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                            placeholder="Select date start" autocomplete="off"
                            value="{{ date('d/m/Y', strtotime($property->check_in)) }}">
                    </div>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input id="check_out" name="check_out" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                            placeholder="Select date end" autocomplete="off"
                            value="{{ date('d/m/Y', strtotime($property->check_out)) }}">
                    </div>
                </div>
            </div>
        </div>

        <h1 class="pt-8 pb-6 font-semibold text-xl">Property rooms</h1>
        <div class="grid grid-cols-3 gap-6">
            <div class="mb-6 w-full">
                <label for="living_room" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Living
                    rooms</label>
                <div class="flex justify-center items-center">
                    <input type="number" id="living_room" wire:model="living_room" name="living_room"
                        value="{{ json_decode($property->rooms_details)->livingRoom }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="mb-6 w-full">
                <label for="bedroom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bedrooms</label>
                <div class="flex justify-center items-center">
                    <input type="number" id="bedroom" wire:model="bedroom" name="bedroom"
                        value="{{ json_decode($property->rooms_details)->bedroom }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="mb-6 w-full">
                <label for="bathroom"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Bathrooms</label>
                <div class="flex justify-center items-center">
                    <input type="number" id="bathroom" wire:model="bathroom" name="bathroom"
                        value="{{ json_decode($property->rooms_details)->bathroom }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
        </div>

        <h1 class="pt-8 pb-6 font-semibold text-xl">Property photos</h1>
        <div class="grid grid-cols-3 gap-6 mb-6">
            {{-- Main photo --}}
            <div class="w-full h-full rounded-sm overflow-hidden border-2 border-blue-600">
                <img class="object-cover h-full"
                    src="{{ Storage::url('property_photos/' . $main_photo['photo_path']) }}" alt="Property image">
            </div>
            {{-- Other photos --}}
            @foreach ($photos as $photo)
                <div wire:click="change_main_photo({{ $photo }})"
                    class="w-full h-full rounded-sm overflow-hidden {{ $photo->is_main ? 'border-2 border-blue-600' : '' }}">
                    <img class="object-cover h-full"
                        src="{{ Storage::url('property_photos/' . $photo->photo_path) }}" alt="Property image">
                </div>
            @endforeach
        </div>
        <div class="flex justify-end">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
        </div>
    </form>
</div>
