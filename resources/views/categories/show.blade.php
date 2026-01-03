@extends('layouts.app')
@section('title',$category->name)

@section('content')
<div class="container my-5">
    <!-- Category Header -->
    <div class="category-header mb-5 p-5 rounded-4 shadow-lg position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100 header-pattern"></div>
        <div class="position-relative">
            <div class="d-flex align-items-center mb-3">
                <div class="category-icon rounded-circle p-3 me-3">
                    <i class="bi bi-grid-fill text-white fs-2"></i>
                </div>
                <div>
                    <h1 class="fw-bold text-white mb-2 display-5">{{ $category->name }}</h1>
                    <p class="text-white mb-0 opacity-90 fs-5">{{ $category->description }}</p>
                </div>
            </div>
            <div class="mt-3">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-box-seam me-1"></i>
                    {{ $category->products->count() }} produit(s)
                </span>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($category->products as $p)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <!-- Image Container -->
                    <div class="position-relative overflow-hidden image-container">
                        <img src="{{ $p->image ? asset('images/products/'.$p->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                             class="card-img-top product-image" alt="{{ $p->name }}">
                        
                        <!-- Stock Badge -->
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($p->stock > 0)
                                <span class="badge stock-badge stock-available">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    {{ $p->stock }} disponible(s)
                                </span>
                            @else
                                <span class="badge stock-badge stock-unavailable">
                                    <i class="bi bi-x-circle-fill me-1"></i>
                                    Rupture
                                </span>
                            @endif
                        </div>

                        <!-- Hover Overlay -->
                        <div class="product-overlay">
                            <a href="{{ route('products.show',$p->id) }}" class="btn btn-light btn-lg rounded-pill shadow">
                                <i class="bi bi-eye-fill me-2"></i>Voir détails
                            </a>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold mb-2 product-title">{{ $p->name }}</h5>
                        
                        <!-- Price -->
                        <div class="price-container mb-3">
                            <span class="price-value">{{ number_format($p->price,2) }}</span>
                            <span class="price-currency">DT</span>
                        </div>

                        <!-- Description -->
                        <p class="text-muted flex-grow-1 mb-3 product-description">
                            {{ Str::limit($p->description, 80) }}
                        </p>

                        <!-- Action Button -->
                        <a href="{{ route('products.show',$p->id) }}" class="btn btn-primary-gradient w-100 btn-action">
                            <i class="bi bi-arrow-right-circle-fill me-2"></i>Découvrir
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center p-5 rounded-4 shadow-sm">
                    <i class="bi bi-inbox fs-1 d-block mb-3 text-primary"></i>
                    <h4 class="fw-bold">Aucun produit disponible</h4>
                    <p class="mb-0">Cette catégorie ne contient pas encore de produits.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Enhanced CSS -->
<style>
    /* Category Header */
    .category-header {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        animation: fadeInDown 0.6s ease;
    }

    .header-pattern {
        background-image: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        opacity: 0.5;
    }

    .category-icon {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Product Cards */
    .product-card {
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        background: white;
    }

    .product-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(13, 110, 253, 0.3);
    }

    /* Image Container */
    .image-container {
        position: relative;
        height: 250px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.1);
    }

    /* Stock Badge */
    .stock-badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        backdrop-filter: blur(10px);
        animation: slideInRight 0.5s ease;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .stock-available {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .stock-unavailable {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        color: white;
    }

    /* Product Overlay */
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(13, 110, 253, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-overlay .btn {
        transform: translateY(20px);
        transition: transform 0.3s ease 0.1s;
    }

    .product-card:hover .product-overlay .btn {
        transform: translateY(0);
    }

    /* Card Title */
    .product-title {
        color: #0d6efd;
        font-size: 1.1rem;
        min-height: 2.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .product-card:hover .product-title {
        color: #6610f2;
    }

    /* Price */
    .price-container {
        display: flex;
        align-items: baseline;
        gap: 0.3rem;
    }

    .price-value {
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .price-currency {
        font-size: 1rem;
        font-weight: 600;
        color: #6c757d;
    }

    /* Description */
    .product-description {
        font-size: 0.9rem;
        line-height: 1.5;
        min-height: 3rem;
    }

    /* Action Button */
    .btn-primary-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%);
        transition: left 0.5s ease;
    }

    .btn-primary-gradient:hover::before {
        left: 100%;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
    }

    .btn-action i {
        transition: transform 0.3s ease;
    }

    .btn-action:hover i {
        transform: translateX(5px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-header {
            padding: 2rem !important;
        }

        .display-5 {
            font-size: 1.8rem;
        }

        .image-container {
            height: 200px;
        }

        .price-value {
            font-size: 1.5rem;
        }
    }

    /* Animation for cards */
    .product-card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
    .product-card:nth-child(6) { animation-delay: 0.6s; }
    .product-card:nth-child(7) { animation-delay: 0.7s; }
    .product-card:nth-child(8) { animation-delay: 0.8s; }
</style>
@endsection