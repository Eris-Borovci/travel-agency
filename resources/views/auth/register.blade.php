@extends("layouts.app", ["hide_nav" => true])

@section("content")
    <div class="flex max-h-screen bg-white">
        <div class="md:w-1/2 max-w-lg mx-auto my-24 px-4 py-5 shadow-none">
            <div class="text-left p-0 font-sans">
                <h1 class=" text-gray-800 text-3xl font-medium">Create an account for free</h1>
                <h3 class="p-1 text-gray-700">Free forever. No payment needed.</h3>
            </div>
            <form action="{{ route("register") }}" method="POST" class="p-0">
                @csrf
                <div class="mt-5">
                    <input name="email" value="{{ old("email") }}" type="text" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="Email">
                </div>
                @error("email")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <div class="mt-5 block md:grid md:grid-cols-2 md:gap-4">
                    <input name="name" value="{{ old("name") }}" type="text" class="block md:col-auto p-2 w-full border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="First name">
                    <input name="lastname" value="{{ old("lastname") }}" type="text" class="mt-5 md:col-auto md:mt-0 w-full block p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="Last name">
                </div>
                @error("name")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <div class="mt-5">
                    <input name="password" type="password" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Password">
                </div>
                <div class="mt-5">
                    <input name="password_confirmation" type="password" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Confirm password">
                </div>
                @error("password")
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="10" />  <line x1="12" y1="16" x2="12" y2="12" />  <line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <div class="mt-10">
                    <input type="submit" value="Sign up with email" class="py-3 bg-green-500 text-white w-full rounded hover:bg-green-600">
                </div>  
            </form>
            <a class="" href="/login" data-test="Link"><span class="block  p-5 text-center text-gray-800  text-xs ">Already have an account?</span></a>
        </div>
    </div>
@endsection