@extends('layouts.app')
@section('title', 'Finaliser la commande')

@section('content')
<div class="main-container">
    <!-- Header -->
    <div class="checkout-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="checkout-title">
                    <i class="bi bi-receipt me-3 text-success"></i>
                    Finaliser la commande
                </h1>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                @endforeach
                <p class="checkout-subtitle mb-0">
                    {{ count($cart) }} produit{{ count($cart) > 1 ? 's' : '' }} • 
                    <strong>{{ number_format($total, 2) }} DT</strong>
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-arrow-left me-2"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>

    <!-- Erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <div class="empty-checkout text-center py-5">
            <i class="bi bi-cart-x display-2 text-muted mb-4"></i>
            <h3 class="text-muted mb-3">Panier vide</h3>
            <p class="text-muted mb-4">Votre panier est vide. Ajoutez des produits avant de passer commande.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-shop me-2"></i> Choisir des produits
            </a>
        </div>
    @else
        <div class="row g-4">
            <!-- Formulaire livraison -->
            <div class="col-lg-7">
                <div class="checkout-form-card">
                    <div class="card-header-custom">
                        <i class="bi bi-truck me-2"></i>
                        Informations de livraison
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('checkout.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" name="fullname" class="form-control form-control-lg @error('fullname') is-invalid @enderror" 
                                           value="{{ old('fullname') }}" required>
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Téléphone <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Adresse complète <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                              rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Ville <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control form-control-lg @error('city') is-invalid @enderror" 
                                           value="{{ old('city') }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Méthode de paiement <span class="text-danger">*</span></label>
                                    <select name="payment_method" class="form-select form-select-lg @error('payment_method') is-invalid @enderror" required>
                                        <option value="">-- Choisir une méthode --</option>
                                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>💰 Cash à la livraison</option>
                                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>💳 Carte bancaire</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-top">
                                <button type="submit" class="btn btn-success btn-lg w-100 checkout-btn shadow-lg">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Confirmer la commande
                                    <span class="badge bg-light text-dark ms-2">{{ number_format($total, 2) }} DT</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Résumé panier -->
            <div class="col-lg-5">
                <div class="checkout-summary-card sticky-top">
                    <div class="card-header-custom">
                        <i class="bi bi-receipt me-2"></i>
                        Résumé de la commande
                    </div>
                    <div class="card-body p-4">
                        @php $orderTotal = 0; @endphp
                        <div class="order-items-list">
                            @foreach($cart as $id => $item)
                                @php 
                                    $itemTotal = $item['price'] * $item['quantity']; 
                                    $orderTotal += $itemTotal; 
                                @endphp
                                <div class="order-item mb-3 p-3 border rounded-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="product-image-placeholder me-3 mb-2 d-inline-block">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="mb-1 fw-semibold">{{ $item['name'] }}</h6>
                                                <small class="text-muted">{{ $item['quantity'] }} × {{ number_format($item['price'], 2) }} DT</small>
                                            </div>
                                        </div>
                                        <span class="text-success fw-bold fs-5">{{ number_format($itemTotal, 2) }} DT</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <hr class="my-3">
                        
                        <div class="total-section">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total</span>
                                <span>{{ number_format($orderTotal, 2) }} DT</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <strong class="fs-4">Total final</strong>
                                <strong class="fs-3 text-success">{{ number_format($orderTotal, 2) }} DT</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Header */
.checkout-header {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.3);
}

.checkout-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
}

.checkout-subtitle {
    font-size: 1.2rem;
    color: #059669;
    font-weight: 600;
}

/* Cards */
.checkout-form-card, .checkout-summary-card {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.05);
    overflow: hidden;
    height: fit-content;
}

.card-header-custom {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 1.5rem 2rem;
    font-weight: 700;
    font-size: 1.1rem;
    border: none;
}

.product-image-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.2rem;
}

.order-item {
    background: #f8fafc;
    transition: all 0.2s ease;
}

.order-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

.checkout-btn {
    border-radius: 20px;
    padding: 1.2rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    height: 60px;
    transition: all 0.3s ease;
}

.checkout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 48px rgba(16, 185, 129, 0.3);
}

/* Sticky summary */
.checkout-summary-card {
    position: sticky;
    top: 20px;
}

.empty-checkout {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 24px;
    padding: 4rem 2rem;
    border: 1px solid rgba(0,0,0,0.05);
}

/* Responsive */
@media (max-width: 992px) {
    .checkout-summary-card {
        position: static;
        margin-top: 2rem;
    }
}

@media (max-width: 768px) {
    .checkout-header {
        padding: 2rem 1.5rem;
    }
    
    .checkout-title {
        font-size: 1.8rem;
    }
}
</style>
@endsection
