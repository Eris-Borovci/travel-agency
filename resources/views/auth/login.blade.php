@extends('layouts.app', ['hide_nav' => true])

@section('content')
    <div class="flex max-h-screen bg-white">
        <div class="md:w-1/2 max-w-lg mx-auto my-24 px-4 py-5 shadow-none">
            <div class="text-left p-0 font-sans">
                <h1 class=" text-gray-800 text-3xl font-medium">Log in your account</h1>
                <h3 class="p-1 text-gray-700">Free forever. No payment needed.</h3>
            </div>
            <form method="POST" action="{{ route('login') }}" class="p-0">
                @csrf
                <div class="mt-5">
                    <input name="email" value="{{ old('email') }}" type="text"
                        class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent "
                        placeholder="Email">
                </div>
                @error('email')
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="16" x2="12" y2="12" />
                            <line x1="12" y1="8" x2="12.01" y2="8" />
                        </svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <div class="mt-5">
                    <input name="password" type="password"
                        class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  "
                        placeholder="Password">
                </div>
                @error('password')
                    <div class="flex items-center mt-2">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="16" x2="12" y2="12" />
                            <line x1="12" y1="8" x2="12.01" y2="8" />
                        </svg>
                        <h1 class="text-red-600 ml-1">{{ $message }}</h1>
                    </div>
                @enderror
                <div class="mt-10">
                    <button class="py-3 bg-blue-600 text-white w-full rounded hover:bg-blue-500 cursor-pointer">Log
                        in</button>
                </div>
            </form>
            <a class="" href="/register" data-test="Link"><span
                    class="block  p-5 text-center text-gray-800  text-xs ">Don't have an account?</span></a>
        </div>
    </div>
@endsection
