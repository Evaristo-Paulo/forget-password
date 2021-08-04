@extends('template')
@section('title', 'Register')
@section('content')
<div class="login-container">
    <div class="login">
        <div class="form-box">
            <div class="title">
                <div class="cover-img">
                    <img src="https://image.flaticon.com/icons/png/512/941/941807.png">
                </div>
                <h2>Admin</h2>
            </div>
            <form action="{{ route('auth.register') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" placeholder="Name" required value="{{ old('name') }}" class="form-control"
                        name="name" id="name">
                </div>
                <div class="form-group">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input type="email" placeholder="Email" required value="{{ old('email') }}" class="form-control"
                        name="email" id="email">
                </div>
                <div class="form-group">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" placeholder="Password" required class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection
