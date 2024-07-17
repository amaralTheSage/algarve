@extends('Layouts.layout')
@section('title', 'Login')


@section('content')
    <main>
        <form action={{ route('auth.authenticate') }} method="POST"
            class="m-auto w-fit flex flex-col py-8 px-8 items-end border bg-white shadow-md  rounded-sm mt-12">
            @csrf
            @method('post')

            <h2 class="w-full font-semibold text-2xl text-text-black pb-1 flex justify-start">
                Login
            </h2>

            <label htmlFor="email-input" class="font-semibold w-full mt-7">
                Email
            </label>
            <input type="text" name="email-input" id="email-input" placeholder="johndoe@gmail.com"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm focus:outline-none" />
            @error('email-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror


            <label htmlFor="password-input" class="font-semibold w-full mt-5">
                Password
            </label>
            <input type="password" name="password-input" id="password-input" placeholder="*********"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm  focus:outline-none" />
            @error('password-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            @if (session('fail'))
                <p class="text-red-500 text-sm w-full">{{ session('fail') }}</p>
            @endif

            <button class="bg-main-blue text-white rounded-md w-[100px] mt-7 py-1 font-medium">
                Submit
            </button>
            <a href="/signup" class="w-full text-main-blue underline underline-offset-2 mt-5">
                Dont have an account? Register here
            </a>
        </form>
    </main>
@endsection
