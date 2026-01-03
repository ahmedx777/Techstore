@extends('layouts.app')
@section('title',$product->name)

@section('content')
<div class="container py-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="/">Accueil</a></li>
      <li class="breadcrumb-item"><a href="#">{{ $product->category->name ?? 'Catégorie' }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row g-4">
    <!-- Image -->
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm">
        <div class="ratio ratio-1x1">
          <img src="{{ $product->image ? asset('images/products/'.$product->image) : 'https://via.placeholder.com/600' }}"
               class="img-fluid rounded"
               style="object-fit: contain; padding: 1rem;"
               alt="{{ $product->name }}">
        </div>
      </div>
    </div>

    <!-- Details -->
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h2 class="mb-1">{{ $product->name }}</h2>
              <p class="text-muted mb-2">{{ $product->category->name ?? '—' }}</p>
            </div>
            <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
              {{ $product->stock > 0 ? 'En stock ('.$product->stock.')' : 'Rupture de stock' }}
            </span>
          </div>

          <div class="my-3">
            <span class="h3 text-primary fw-bold">{{ number_format($product->price,2) }} DT</span>
          </div>

          <p class="mb-4">{{ $product->description }}</p>

          <!-- Actions -->
          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex flex-wrap gap-2 align-items-end">
            @csrf
            <div style="max-width:140px;">
              <label class="form-label">Quantité</label>
              <input type="number" name="quantity" value="1" min="1" class="form-control">
            </div>
            <button class="btn btn-success px-4" @if($product->stock <= 0) disabled @endif>
              🛒 Ajouter au panier
            </button>
            @auth
              <button formaction="{{ route('favorites.add', $product->id) }}" formmethod="GET" class="btn btn-outline-warning">
                ⭐ Favoris
              </button>
            @endauth
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Reviews -->
  <div class="mt-5">
    <h4 class="mb-3">Avis des clients</h4>
    @forelse($product->reviews as $review)
      <div class="card mb-3 border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <strong>{{ $review->user->name ?? 'Utilisateur' }}</strong>
            <span class="text-muted small">{{ $review->created_at->format('d/m/Y') }}</span>
          </div>
          <div class="mt-1">
            @for($i=1; $i<=5; $i++)
              <span class="{{ $i <= $review->rate ? 'text-warning' : 'text-secondary' }}">&#9733;</span>
            @endfor
          </div>
          <p class="mt-2 mb-0">{{ $review->comment }}</p>
        </div>
      </div>
    @empty
      <p class="text-muted">Aucun avis pour le moment.</p>
    @endforelse
  </div>

  @auth
    <div class="card mt-4 border-0 shadow-sm">
      <div class="card-body">
        <h5 class="mb-3">Laisser un avis</h5>
        <form action="{{ route('reviews.store') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">

          <div class="mb-3">
            <label class="form-label d-block">Votre note</label>
            <div class="star-rating">
              @for($i=5; $i>=1; $i--)
                <input type="radio" id="star{{ $i }}" name="rate" value="{{ $i }}" required>
                <label for="star{{ $i }}">&#9733;</label>
              @endfor
            </div>
          </div>

          <div class="mb-3">
            <textarea name="comment" class="form-control" rows="3" placeholder="Écrivez votre avis..."></textarea>
          </div>

          <button class="btn btn-primary px-4">Envoyer</button>
        </form>
      </div>
    </div>
  @endauth
</div>

<style>
.star-rating{direction:rtl;display:inline-flex;font-size:1.6rem}
.star-rating input{display:none}
.star-rating label{color:#ddd;cursor:pointer;transition:.2s}
.star-rating input:checked~label,
.star-rating label:hover,
.star-rating label:hover~label{color:#ffc107}
</style>
@endsection
