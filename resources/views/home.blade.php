@extends('layouts.app')

@section('title', 'Bienvenue chez TechStore')

@section('content')
<style>
/* HOMEPAGE STYLES - PERFECT MATCH WITH ORIGINAL LAYOUT */
.hero-section {
    background: linear-gradient(135deg, rgba(13,110,253,0.95), rgba(102,16,242,0.95));
    color: white;
    padding: 5rem 2rem;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 4rem;
    box-shadow: 0 10px 40px rgba(13,110,253,0.3);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.3rem;
    opacity: 0.95;
    margin-bottom: 2.5rem;
}

.hero-buttons .btn {
    padding: 14px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    margin: 0 10px;
    transition: all 0.3s ease;
}

.hero-buttons .btn-primary {
    background: #ffc107;
    border-color: #ffc107;
    color: #000;
}

.hero-buttons .btn-primary:hover {
    background: #ffda44;
    border-color: #ffda44;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,193,7,0.4);
}

.hero-buttons .btn-outline-light:hover {
    background: white;
    color: #0d6efd;
    transform: translateY(-2px);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0d6efd;
    text-align: center;
    margin-bottom: 1rem;
}

.section-subtitle {
    color: #6c757d;
    text-align: center;
    font-size: 1.2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 2.5rem 1.5rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #f8f9fa;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stat-icon {
    font-size: 3rem;
    color: #0d6efd;
    margin-bottom: 1rem;
    display: block;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0d6efd;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6c757d;
    font-weight: 600;
    font-size: 1.1rem;
}

.category-card {
    background: white;
    border-radius: 15px;
    padding: 2.5rem 2rem;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #f8f9fa;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.category-icon {
    width: 85px;
    height: 85px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 25px rgba(13,110,253,0.3);
}

.category-icon i {
    font-size: 2.2rem;
    color: white;
}

.category-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 1rem;
}

.category-desc {
    color: #6c757d;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.category-badge {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: white;
    padding: 8px 18px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
}

.empty-state {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 4rem;
    border-radius: 20px;
    border: 2px dashed #dee2e6;
    text-align: center;
    color: #6c757d;
}

.empty-state h3 {
    color: #495057;
    font-weight: 700;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    .hero-buttons .btn {
        display: block;
        margin: 10px 0;
        width: 100%;
    }
}
</style>

<!-- HERO SECTION -->
<div class="hero-section">
    <h1 class="hero-title">
        <i class="bi bi-shop-window me-3"></i>
        Bienvenue chez TechStore
    </h1>
    <p class="hero-subtitle">
        Découvrez nos smartphones, PC, consoles et accessoires premium
    </p>
    
    <div class="hero-buttons">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-shop me-2"></i> Voir tous les produits
        </a>
        
    </div>
</div>

<!-- STATS SECTION -->
<div class="container mb-5">
    <div class="row g-4 text-center">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <i class="bi bi-box-seam stat-icon"></i>
                <h3 class="stat-number">50+</h3>
                <p class="stat-label">Produits disponibles</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <i class="bi bi-grid stat-icon"></i>
                <h3 class="stat-number">{{ $categories->count() }}</h3>
                <p class="stat-label">Catégories</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <i class="bi bi-people stat-icon"></i>
                <h3 class="stat-number">100+</h3>
                <p class="stat-label">Clients satisfaits</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <i class="bi bi-shield-check stat-icon"></i>
                <h3 class="stat-number">100%</h3>
                <p class="stat-label">Satisfaction garantie</p>
            </div>
        </div>
    </div>
</div>

<!-- CATEGORIES SECTION -->
<div class="container">
    <div class="text-center mb-5">
        <h2 class="section-title">
            <i class="bi bi-cpu me-2"></i>Nos Catégories
        </h2>
        <p class="section-subtitle">Découvrez nos gammes de produits high-tech</p>
    </div>

    <div class="row g-4">
        @forelse($categories as $category)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                    <div class="category-card h-100">
                        <div class="category-icon">
                            <i class="bi bi-{{ $category->icon ?? 'tag-fill' }}"></i>
                        </div>
                        <h4 class="category-name">{{ $category->name }}</h4>
                        <p class="category-desc">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                        @if($category->products()->count() > 0)
                            <span class="category-badge">
                                {{ $category->products()->count() }} produits
                            </span>
                        @endif
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-inbox2 display-4 mb-4 opacity-75"></i>
                    <h3>Aucune catégorie disponible</h3>
                    <p class="lead">Nos catégories seront bientôt disponibles. Restez connecté !</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection
