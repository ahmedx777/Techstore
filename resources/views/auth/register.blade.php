@extends('layouts.app')
@section('title','Register')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 450px;">
        <h2 class="text-center text-success mb-4">📝 Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nom complet">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Exemple@exemple.com">
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmez mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe">
            </div>
            <button class="btn btn-success w-100">Register</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">Already have an account? 
                <a href="{{ route('login.form') }}" class="text-decoration-none">Login</a>
            </small>
        </div>
    </div>
</div>
@endsection