@extends('Layouts.layout')
@section('title', 'For you')


@section('content')
    <main class="w-[85%] m-auto md:flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <section class="md:w-[48%]">
            <div class="md:hidden ">
                @include('Components.nav-bar-mobile')
                @livewire('search')
            </div>
            <livewire:form-and-post-list page="foryou" userId="{{ Auth::id() }}" />
        </section>

        <div class="md:w-[26%] hidden md:block">
            @livewire('search')

            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
