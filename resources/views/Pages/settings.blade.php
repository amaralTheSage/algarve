@extends('Layouts.layout')
@section('title', 'Settings')


@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')


        <div class="w-[48%] font-semibold ">
            <h2 class="text-2xl ">Settings</h2>
            <span class="">not yet implemented lol ;)</span>
        </div>


        <div class="w-[26%] ">
            @livewire('search')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
