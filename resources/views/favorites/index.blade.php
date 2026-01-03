@extends('layouts.app')
@section('title','Favorites')

@section('content')
<div class="container my-4">
    <h2 class="fw-bold text-danger mb-4">
        <i class="bi bi-heart-fill"></i> Your Favorites
    </h2>

    <div class="row">
        @forelse($favorites as $fav)
            @php $p = $fav->product; @endphp
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <img src="{{ $p->image ? asset('images/products/'.$p->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                         class="card-img-top" alt="{{ $p->name }}">
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-bold text-dark">{{ $p->name }}</h6>
                        <p class="text-success mb-2">{{ number_format($p->price,2) }} DT</p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                            <a href="{{ route('favorites.remove', $p->id) }}" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> Enlever
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> T'as pas des Favorites.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Small CSS tweak -->
<style>
.product-card:hover {
    transform: translateY(-5px);
    transition: 0.3s ease-in-out;
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
}
</style>
@endsection