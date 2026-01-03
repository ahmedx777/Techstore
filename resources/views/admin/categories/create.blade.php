@extends('layouts.app')
@section('title','Ajouter une catégorie')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="text-center text-info mb-4">➕ Ajouter une catégorie</h2>

            <div class="mb-3 text-end">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    ⬅️ Retour à la liste des catégories
                </a>
            </div>

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom de la catégorie</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <button class="btn btn-info w-100">Ajouter la catégorie</button>
            </form>
        </div>
    </div>
</div>
@endsection