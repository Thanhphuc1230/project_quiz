@extends('login.master')
@section('title', 'Forgot password')
@section('content')
    <form action="{{ route('resetPassword') }}" method="post">
        @csrf
        <div class="field input-field">
            <input type="text" placeholder="Email" class="input" name="email" value="{{ $email ?? old('email') }}"
                disabled>
        </div>
        <div class="field input-field">
            <input type="password" placeholder="Password" class="input" name="password">
        </div>
        <div class="field input-field">
            <input type="password" placeholder="Password" class="input" name="password_confirmation">
        </div>
        <input type="hidden" placeholder="Email" class="input" name="email" value="{{ $email ?? old('email') }}">
        <div class="field button-field">
            <button type="submit">Cập nhật mật khẩu</button>
        </div>
    </form>
    </div>
@endsection
