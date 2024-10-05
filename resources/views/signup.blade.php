@extends('app')

@section('title')
    Sign up
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

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .error-message {
            color: red;
            min-height: 24px;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <h2>Sign Up</h2>
        <form action="{{ route('signupdata') }}" method="POST">
            @csrf
            <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id', $user->user_id ?? '') }}" />
            <div class="form-group">
                <input type="text" id="username" name="username" value="{{ old('username', $user->user_username ?? '') }}"
                    placeholder="Enter Username" class="form-control">
                <span class="error-message">
                    {{ $errors->first('username') }}
                </span>
            </div>

            <div class="form-group">
                <input type="email" id="email" name="email" value="{{ old('email', $user->user_email ?? '') }}"
                    placeholder="Please Enter Email" class="form-control">
                <span class="error-message">
                    {{ $errors->first('email') }}
                </span>
            </div>

            <div class="form-group" style="position: relative;">
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password"
                    class="form-control">
                <span class="error-message">
                    {{ $errors->first('password') }}
                </span>
                <span class="toggle-password" style="position: absolute; right: 10px; top: 10px; cursor: pointer;">
                    <i class="fa fa-eye" id="togglePassword"></i>
                </span>
            </div>

            <div class="form-group">
                <input type="password" id="cpassword" name="cpassword" value="{{ old('cpassword',$user->user_ipassword ?? '') }}"
                    placeholder="Confirm Password" class="form-control">
                <span class="error-message">
                    {{ $errors->first('cpassword') }}
                </span>
            </div>
            @if (!isset($user->user_id))
            <button type="submit" class="btn btn-primary">Sign Up</button>
        @else
            <button type="submit" class="btn btn-primary">Update</button>
        @endif

        </form>
        @if (!isset($user->user_id))
            <span style="text-align:right;margin-top:5px;">
                Have an account? <a href="/signin">Log in</a>
            </span>
        @endif
    </div>
@endsection
@push('script')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        this.classList.toggle('fa-eye-slash');
    });
</script>   
@endpush
