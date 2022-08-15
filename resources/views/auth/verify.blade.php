@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="shadow-lg">
            <div class="card">
                <div class="card-header text-gray-700 px-4 py-4 bg-gray-100 rounded-md font-semibold text-2xl">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body px-4 py-6 text-gray-700">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-blue-700">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
