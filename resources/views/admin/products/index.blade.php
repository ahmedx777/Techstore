@extends('layouts.app')
@section('title','Gestion des produits')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-primary">📦 Gestion des produits</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">➕ Ajouter un produit</a>

    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>{{ $product->price }} DT</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name ?? '—' }}</td>
                    <td class="d-flex gap-2">
                        <!-- Voir -->
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">👁️ Voir</a>
                        <!-- Modifier -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning">✏️ Modifier</a>
                        <!-- Supprimer -->
                        <form method="POST" action="{{ route('admin.products.delete', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">Aucun produit trouvé</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection