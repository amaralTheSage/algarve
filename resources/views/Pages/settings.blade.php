@extends('Layouts.layout')
@section('title', 'Settings')



@section('content')
    <main class="w-[85%] m-auto md:flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <section class="md:w-[48%]">
            <div class="md:hidden ">
                @include('Components.nav-bar-mobile')
            </div>
            <div class="m-5 font-semibold">
                <h2 class="text-2xl ">Settings</h2>
                <span class="">not yet implemented lol ;)</span>
            </div>
        </section>

        <div class="md:w-[26%] hidden md:block">
            @livewire('search')

            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
