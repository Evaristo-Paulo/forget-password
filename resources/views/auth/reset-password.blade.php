@extends('template')
@section('title', 'Reset Password')
@section('content')
<div class="login-container">
    <div class="login">
        <div class="form-box">
            <div class="title">
                <div class="cover-img">
                    <img src="https://image.flaticon.com/icons/png/512/941/941807.png">
                </div>
                <h2>Reset Password</h2>
            </div>
            <form action="{{ route('auth.reset.password') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" readonly placeholder="Email" required value="{{ $user->email }}" class="form-control"
                        name="email" id="email">
                </div>
                <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="New password" value="{{ old('password')}}" required class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Confirm password" value="{{ old('confirmPassword')}}" required class="form-control" name="confirmPassword" id="confirmPassword">
                </div>
                <button type="submit" class="btn">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
