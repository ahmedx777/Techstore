@extends('layouts.app')
@section('title','Modifier un produit')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-body">
            <h2 class="text-center text-warning mb-4">✏️ Modifier le produit</h2>

            <!-- Bouton retour vers la liste -->
            <div class="mb-3 text-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    ⬅️ Retour à la liste des produits
                </a>
            </div>

            <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="mb-3">
                    <label class="form-label">Nom du produit</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name',$product->name) }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description',$product->description) }}</textarea>
                </div>

                <!-- Prix -->
                <div class="mb-3">
                    <label class="form-label">Prix</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price',$product->price) }}" required>
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock',$product->stock) }}" required>
                </div>

                <!-- Catégorie -->
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Marque -->
                <div class="mb-3">
                    <label class="form-label">Marque</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand',$product->brand) }}">
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Image (URL)</label>
                    <input type="text" name="image" class="form-control" value="{{ old('image',$product->image) }}">
                </div>

                <button class="btn btn-warning w-100">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection