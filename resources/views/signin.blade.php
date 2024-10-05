@extends('app')

@section('title')
    Sign in
@endsection
@php
    unset($_SESSION['LoggedIn']);
@endphp
@section('style')
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
            outline: none;
            color: #333;
        }

        input:focus {
            border-color: #555;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
@endsection

@section('content')
@if ($errors->has('session_expired'))
    <div class="alert alert-danger">
        {{ $errors->first('session_expired') }}
    </div>
@endif
    <div class="card">
        <h2>Sign In</h2>
        @if ($errors->has('login_error'))
            <div class="alert alert-danger">
                {{ $errors->first('login_error') }}
            </div>
        @endif
        <form action="{{ route('signindata') }}" method="POST">
            @csrf
            <input type="text" id="username" name="username" value="{{ session('username', old('username')) }}"
                placeholder="{{ $errors->has('username') ? $errors->first('username') : 'Username' }}">

            <input type="password" id="password" name="password" value="{{ session('password', old('password')) }}"
                placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}">
            <button type="submit">Sign In</button>
        </form>
        <span style="text-align:right;margin-top:5px;">Don't have an account? <a href="/signup">Sign up</a></span>
    </div>
@endsection
