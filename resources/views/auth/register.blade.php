@extends('layouts.app', ['title' => 'Register'])

@section('content')
    <div class="mx-auto max-w-md rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-black tracking-tight text-zinc-950">Create Account</h1>
        <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="text-sm font-bold text-zinc-800" for="name">Name</label>
                <input id="name" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
            </div>
            <div>
                <label class="text-sm font-bold text-zinc-800" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
            </div>
            <div>
                <label class="text-sm font-bold text-zinc-800" for="password">Password</label>
                <input id="password" type="password" name="password" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
            </div>
            <div>
                <label class="text-sm font-bold text-zinc-800" for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="mt-1 w-full rounded-md border border-zinc-300 px-3 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
            </div>
            <button class="w-full rounded-md bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700" type="submit">Register</button>
        </form>
        <p class="mt-5 text-center text-sm text-zinc-600">
            Already registered?
            <a class="font-bold text-emerald-700 hover:text-emerald-800" href="{{ route('login') }}">Login</a>
        </p>
    </div>
@endsection
