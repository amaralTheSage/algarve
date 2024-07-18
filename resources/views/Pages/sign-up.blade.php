@extends('Layouts.layout')

@section('title', 'Sign Up')


@section('content')
    <main>
        <form action={{ route('auth.register') }} method="POST"
            class="m-auto w-fit flex flex-col py-6 px-8 items-end border bg-white shadow-md  rounded-sm mt-4">
            @csrf
            @method('post')

            <h2 class="w-full font-semibold text-2xl text-text-black pb-1 flex justify-start">

                Register
            </h2>
            <label htmlFor="username-input" class="font-semibold w-full mt-5">
                Username
            </label>
            <input type="text" name="username-input" id="username-input" placeholder="amaralTheSage"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm focus:outline-none" />
            @error('username-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <label htmlFor="email-input" class="font-semibold w-full mt-5">
                Email
            </label>
            <input type="text" name="email-input" placeholder="johndoe@gmail.com" id="email-input"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm focus:outline-none" />
            @error('email-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <label htmlFor="password-input" class="font-semibold w-full mt-5">
                Password
            </label>
            <input type="password" placeholder="*********" name="password-input" id="password-input"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm  focus:outline-none" />
            @error('password-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <label htmlFor="password-input_confirmation" class="font-semibold w-full mt-5">
                Confirm Password
            </label>
            <input type="password" name="password-input_confirmation" id="password-input_confirmation"
                placeholder="*********"
                class="border rounded-[4px] px-2 w-[385px] text-lg h-[40px] shadow-sm focus:outline-none" />
            @error('password-input')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <button class="bg-main-blue text-white rounded-md w-[100px] mt-5 py-1 font-medium">
                Sign Up
            </button>
            <a href="/login" class="w-full text-main-blue underline underline-offset-2 mt-5">
                Already have an account? Login here
            </a>
        </form>
    </main>
@endsection
