@extends('Layouts.layout')
@section('title', 'Feed')


@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')


        <div class="w-[48%] ">
            @auth
                @include('Components.post-form')
            @endauth
            @guest
                <h3 class="text-2xl font-semibold">Log in to share your thoughts!</h3>
            @endguest


            <section class="mt-3">
                @foreach ($posts as $post)
                    @include('Components.post-card')
                @endforeach
            </section>
        </div>


        <div class="w-[26%] ">
            @include('Components.search-bar')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
