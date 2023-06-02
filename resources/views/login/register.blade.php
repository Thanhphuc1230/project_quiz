@extends('login.master')
@section('title', 'Register')
@section('content')
    <form action="{{ route('postRegister') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="email" value="{{ old('email') }}">
        </div>

        <div class="field input-field">
            <input type="password" placeholder="Password" class="password" name="password">
            <i class='bx bx-hide eye-icon'></i>
        </div>
        <div class="field input-field">
            <input type="password" placeholder="Password" class="password"name="password_confirmation">
            <i class='bx bx-hide eye-icon'></i>
        </div>

        <div class="form-link">
            <a href="{{ route('getLogin') }}" class="forgot-pass">Login</a>
        </div>

        <div class="field button-field">
            <button type="submit">Đăng ký</button>
        </div>
    </form>
@endsection
