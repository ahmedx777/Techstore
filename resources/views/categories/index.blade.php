@extends('layouts.app')
@section('title', 'Catégories')

@section('content')
<div class="main-container">
    <!-- Header -->
    <div class="categories-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="categories-title">
                    <i class="bi bi-grid-3x3-gap-fill me-3 text-primary"></i>
                    Toutes les catégories
                </h1>
                <p class="categories-subtitle mb-0">{{ $categories->count() }} catégorie{{ $categories->count() > 1 ? 's' : '' }} disponibles</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-shop me-2"></i> Voir tous les produits
                </a>
            </div>
        </div>
    </div>

    @include('partials._alerts')

    <!-- Grille catégories -->
    <div class="categories-grid">
        <div class="row g-4">
            @forelse($categories as $category)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <a href="{{ route('categories.show', $category->id) }}" class="category-card-link">
                        <div class="category-card">
                            <div class="category-icon">
                                <i class="bi bi-{{ $category->icon ?? 'box' }}"></i>
                            </div>
                            <div class="category-content">
                                <h3 class="category-name">{{ $category->name }}</h3>
                                <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                                @if($category->products_count ?? $category->products()->count() > 0)
                                    <div class="category-stats">
                                        <span class="badge bg-success">
                                            <i class="bi bi-box-seam me-1"></i>
                                            {{ $category->products_count ?? $category->products()->count() }} produit{{ $category->products_count ?? $category->products()->count() > 1 ? 's' : '' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="category-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <i class="bi bi-folder-x display-2 text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Aucune catégorie</h3>
                        <p class="text-muted mb-4">Les catégories seront ajoutées bientôt.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg px-5">
                            <i class="bi bi-shop me-2"></i> Explorer les produits
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
/* Header - Même style que panier/checkout */
.categories-header {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.3);
}

.categories-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1.2;
}

.categories-subtitle {
    font-size: 1.2rem;
    color: #64748b;
}

/* Cards - Même style que les autres pages */
.category-card-link {
    text-decoration: none;
    display: block;
    height: 100%;
}

.category-card {
    background: #fff;
    border-radius: 20px;
    padding: 2.5rem 2rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #3b82f6, #10b981);
}

.category-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 24px 64px rgba(0,0,0,0.15);
}

.category-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
}

.category-content {
    text-align: center;
}

.category-name {
    font-size: 1.4rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.category-description {
    color: #64748b;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.category-stats {
    margin-top: auto;
}

.badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.category-arrow {
    position: absolute;
    top: 50%;
    right: 1.5rem;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #10b981, #059669);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    opacity: 0;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
}

.category-card:hover .category-arrow {
    opacity: 1;
    right: 1rem;
    transform: translateY(-50%) scale(1.1);
}

/* Empty state */
.empty-state {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 24px;
    border: 1px solid rgba(0,0,0,0.05);
}

/* Responsive */
@media (max-width: 768px) {
    .categories-header {
        padding: 2rem 1.5rem;
    }
    
    .categories-title {
        font-size: 1.8rem;
    }
    
    .category-card {
        padding: 2rem 1.5rem;
    }
}
</style>
@endsection
