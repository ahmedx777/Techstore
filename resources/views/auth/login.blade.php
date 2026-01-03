@extends('layouts.app')
@section('title','Login')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h2 class="text-center text-primary mb-4">🔐 Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">Don't have an account? 
                <a href="{{ route('register.form') }}" class="text-decoration-none">Register</a>
            </small>
        </div>
    </div>
</div>
@endsection