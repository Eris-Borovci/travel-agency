@extends('layouts.app', ['hide_nav' => true])

@section('content')
    @livewireStyles()
    <livewire:edit :property="$property" />
    @livewireScripts()
@endsection
