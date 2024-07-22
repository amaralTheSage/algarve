@extends('Layouts.layout')
@section('title', 'Feed')


@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')


        <livewire:form-and-post-list page="feed" userId={{ Auth::id() }} />


        <div class="w-[26%] ">
            @livewire('search')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
