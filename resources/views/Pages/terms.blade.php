@extends('Layouts.layout')
@section('title', 'Terms')


@section('content')
    <main class="w-[85%] m-auto md:flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <section class="md:w-[48%]">
            <div class="md:hidden ">
                @include('Components.nav-bar-mobile')
            </div>
            <div class="m-5">
                <h2 class="text-2xl font-semibold ">Terms</h2>
                <nl class="font-semibold underline underline-offset-2">
                    <li>Hold back on the chinelage</li>
                </nl>
            </div>
        </section>

        <div class="md:w-[26%] hidden md:block">
            @livewire('search')

            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
