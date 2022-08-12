@extends("layouts.app")

@section("content")
    <form class="flex max-h-screen bg-white" method="POST" action="{{ route("register") }}">
        @csrf

        <div class="md:w-1/2 max-w-lg mx-auto my-24 px-4 py-5 shadow-none">

            <div class="text-left p-0 font-sans">
                
                <h1 class=" text-gray-800 text-3xl font-medium">Create an account for free</h1>
                <h3 class="p-1 text-gray-700">Free forever. No payment needed.</h3>
            </div>
            <form action="#" class="p-0">
                <div class="mt-5">
                    <input name="email" type="text" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="Email">
                </div>
                <div class="mt-5 block md:grid md:grid-cols-2 md:gap-4">
                    <input name="firstname" type="text" class="block md:col-auto p-2 w-full border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="First name">
                    <input name="lastname" type="text" class="mt-5 md:col-auto md:mt-0 w-full block p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent " placeholder="Last name">
                </div>
                <div class="mt-5">
                    <input name="password" type="password" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Password">
                </div>
                <div class="mt-5">
                    <input name="confirm_password" type="password" class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  " placeholder="Confirm password">
                </div>
                <div class="mt-10">
                    <input type="submit" value="Sign up with email" class="py-3 bg-green-500 text-white w-full rounded hover:bg-green-600">
                </div>
            </form>
            <a class="" href="/login" data-test="Link"><span class="block  p-5 text-center text-gray-800  text-xs ">Already have an account?</span></a>
        </div>
    </form>
@endsection