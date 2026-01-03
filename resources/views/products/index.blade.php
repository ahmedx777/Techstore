@extends('layouts.app')
@section('title','Produits')

@section('content')
<div class="row mb-3">
  <div class="col-md-8">
    <form method="GET" class="row g-2 align-items-end">
      <!-- Recherche -->
      <div class="col-auto">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Rechercher un produit...">
        </div>
      </div>

      <!-- Filtre catégorie -->
      <div class="col-auto">
        <select name="category_id" class="form-select">
          <option value="">Toutes les catégories</option>
          @foreach(\App\Models\Category::all() as $c)
            <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>
              {{ $c->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Tri prix -->
      <div class="col-auto">
        <select name="sort" class="form-select">
          <option value="">Par défaut</option>
          <option value="asc" @selected(request('sort') == 'asc')>Prix croissant</option>
          <option value="desc" @selected(request('sort') == 'desc')>Prix décroissant</option>
        </select>
      </div>

      <!-- Boutons -->
      <div class="col-auto">
        <button class="btn btn-primary"><i class="bi bi-funnel"></i> Appliquer</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Annuler</a>
      </div>
    </form>
  </div>

  <!-- Raccourci panier -->
  <div class="col-md-4 text-end">
    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-cart"></i> Panier
    </a>
  </div>
</div>

<div class="row">
  @forelse($products as $p)
    <div class="col-md-3 mb-4">
      <a href="{{ route('products.show', $p->id) }}" class="text-decoration-none text-dark">
        <div class="card h-100 shadow-sm product-card">
          <img src="{{ $p->image ? asset('images/products/'.$p->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
               class="card-img-top" alt="{{ $p->name }}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $p->name }}</h5>
            <p class="text-muted mb-1">{{ $p->category->name ?? 'Non catégorisé' }}</p>
            @if($p->brand)
              <p class="small text-secondary">Marque : {{ $p->brand }}</p>
            @endif

            <!-- Stock -->
            @if($p->stock > 0)
              <span class="badge bg-success mb-2">En stock ({{ $p->stock }})</span>
            @else
              <span class="badge bg-danger mb-2">Rupture de stock</span>
            @endif

            <p class="card-text text-muted flex-grow-1">{{ Str::limit($p->description, 80) }}</p>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <div><strong>{{ number_format($p->price,2) }} DT</strong></div>
              <span class="btn btn-sm btn-primary">Détails</span>
            </div>
          </div>
        </div>
      </a>
    </div>
  @empty
    <div class="col-12"><p class="text-muted">Aucun produit trouvé.</p></div>
  @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center my-4">
    {{ $products->withQueryString()->links() }}
</div>

<style>
.product-card {
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 0.8rem 1.2rem rgba(0,0,0,0.2);
}
.card-title {
  font-weight: bold;
  color: #0d6efd;
}
.badge {
  font-size: 0.85rem;
}
</style>
@endsection