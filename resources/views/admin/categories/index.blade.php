@extends('layouts.app')
@section('title','Gestion des catégories')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-info">🗂️ Gestion des catégories</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn btn-info mb-3">➕ Ajouter une catégorie</a>

    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '—' }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">✏️ Modifier</a>
                        <form method="POST" action="{{ route('admin.categories.delete', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-muted">Aucune catégorie trouvée</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection