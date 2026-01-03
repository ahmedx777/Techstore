@extends('layouts.app')
@section('title','Modifier une catégorie')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="text-center text-warning mb-4">✏️ Modifier la catégorie</h2>

            <div class="mb-3 text-end">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    ⬅️ Retour à la liste des catégories
                </a>
            </div>

            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom de la catégorie</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name',$category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description',$category->description) }}</textarea>
                </div>

                <button class="btn btn-warning w-100">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection