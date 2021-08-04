@extends('template')
@section('title', 'Login')
@section('content')
<div class="login-container">
    <div class="login">
        <div class="form-box">
            <div class="title">
                <div class="cover-img">
                    <img src="https://image.flaticon.com/icons/png/512/941/941807.png">
                </div>
                <h2>Let's surf, bruh!</h2>
            </div>
            <form action="{{ route('auth.login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" required value="{{ old('email') }}" class="form-control"
                        name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" required class="form-control" name="password" id="password">
                </div>
                <p class="auth-info">
                    <a href="{{ route('forget.password') }}">Forget your password?</a>
                </p>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
