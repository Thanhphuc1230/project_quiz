@extends('login.master')
@section('title', 'Login')
@section('content')
    <form action="{{ route('postLogin') }}" method="post">
        @csrf
        <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="email">
        </div>

        <div class="field input-field">
            <input type="password" placeholder="Password" class="password" name="password">
            <i class='bx bx-hide eye-icon'></i>
        </div>

        <div class="form-link">
            <a href="{{ route('getForgot') }}" class="forgot-pass">Forgot password?</a>
        </div>

        <div class="field button-field">
            <button type="submit">Login</button>
        </div>
    </form>
    <div class="form-link">
        <span>Don't have an account? <a href="{{ route('getRegister') }} " class="link signup-link">Signup</a></span>
    </div>
    </div>

    <div class="line"></div>

    <div class="media-options">
        <a href="{{ route('provider-auth', ['provider' => 'github']) }}" class="field facebook">
            <i class='bx bxl-facebook facebook-icon'></i>
            <span>Login with Facebook</span>
        </a>
    </div>

    <div class="media-options">
        <a href="{{ route('provider-auth', ['provider' => 'google']) }}" class="field google">
            <img src="{{ asset('login_user/images/google.png') }}" alt="" class="google-img">
            <span>Login with Google</span>
        </a>
    </div>
@endsection
