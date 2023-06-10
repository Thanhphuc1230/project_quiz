@extends('login.master')
@section('title', 'Forgot password')
@section('content')
    <form action="{{ route('sendResetLink') }}" method="post">
        @csrf
        <div class="field input-field">
            <input type="email" placeholder="Email" class="input" name="email">
        </div>

        <div class="field button-field">
            <button type="submit">Quên mật khẩu</button>
        </div>
    </form>
    <div class="form-link">
        <span>Don't have an account? <a href="{{ route('getRegister') }} " class="link signup-link">Signup</a></span>
    </div>
    </div>
@endsection
