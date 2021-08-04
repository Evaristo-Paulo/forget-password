@extends('template')
@section('title', 'Forget Password')
@section('content')
<div class="login-container">
    <div class="login">
        <div class="form-box">
            <div class="title">
                <div class="cover-img">
                    <img src="https://image.flaticon.com/icons/png/512/941/941807.png">
                </div>
                <h2>Forget Password</h2>
                <p class="auth-info">
                    <a href="#">We'll send a link to this email</a>
                </p>
            </div>
            <form id="forgetPassword" action="{{ route('auth.forget.password') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" placeholder="Email" required value="{{ old('email') }}"
                        class="form-control" name="email" id="email">
                </div>
                <button type="submit" class="btn">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection