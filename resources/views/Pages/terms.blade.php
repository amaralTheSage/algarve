@extends('Layouts.layout')
@section('title', 'Terms')


@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')


        <div class="w-[48%] ">
            <h2 class="text-2xl font-semibold ">Terms</h2>
            <nl class="font-semibold underline underline-offset-2">
                <li>Sem muita chinelage</li>
            </nl>
        </div>


        <div class="w-[26%] ">
            @livewire('search')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
