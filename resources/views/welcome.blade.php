@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
        <h1>Welcome to DevConnect</h1>

    @auth
        <p>Hello, {{ auth()->user()->name }}! Go to your <a href="{{ route('dashboard') }}">Dashboard</a>.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Register</a>
    @endauth
@endsection


