@extends('layouts.app')
@section('title', 'Votre Panier')

@section('content')
<div class="container py-5">

    <!-- Header -->
    <div class="cart-header mb-5 p-4 shadow-sm rounded-4 bg-white border">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="cart-title fw-bold mb-2">
                    <i class="bi bi-cart-fill me-3 text-success"></i>Votre panier
                </h1>
                @if(!empty($cart) && count($cart) > 0)
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item) @php $total += $item['price'] * $item['quantity']; @endphp @endforeach
                    <p class="cart-subtitle mb-0 text-muted">
                        {{ count($cart) }} produit{{ count($cart) > 1 ? 's' : '' }} • <strong>{{ number_format($total, 2) }} DT</strong>
                    </p>
                @endif
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                    <i class="bi bi-shop me-2"></i> Continuer vos achats
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Erreur -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <!-- Panier vide -->
        <div class="empty-cart p-5 rounded-4 text-center bg-light shadow-sm">
            <i class="bi bi-cart-x display-1 text-muted mb-3"></i>
            <h3 class="mb-3 text-muted">Votre panier est vide</h3>
            <p class="text-muted mb-4">Ajoutez des produits pour voir votre panier ici.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-shop me-2"></i> Découvrir les produits
            </a>
        </div>
    @else
        <!-- Tableau Panier -->
        <div class="cart-table-container shadow-sm rounded-4 overflow-hidden bg-white border mb-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $grandTotal += $subtotal; @endphp
                            <tr class="align-middle">
                                <td class="d-flex align-items-center">
                                    <div class="product-image-placeholder me-3 d-flex align-items-center justify-content-center rounded-3 bg-light" style="width:60px;height:60px;">
                                        <i class="bi bi-box-seam fs-4 text-muted"></i>
                                    </div>
                                    <div class="product-details">
                                        <h6 class="mb-0 fw-semibold">{{ $item['name'] }}</h6>
                                    </div>
                                </td>
                                <td>{{ number_format($item['price'], 2) }} DT</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.update', $id) }}" class="d-flex align-items-center gap-1">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 120px;">
                                            <button type="button" class="btn btn-outline-secondary decrement" style="width: 35px; height: 35px; padding: 0;">-</button>
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control text-center" style="height: 35px; font-size: 0.9rem;">
                                            <button type="button" class="btn btn-outline-secondary increment" style="width: 35px; height: 35px; padding: 0;">+</button>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm update-btn">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><strong class="text-success">{{ number_format($subtotal, 2) }} DT</strong></td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer {{ $item['name'] }} ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total et Checkout -->
        <div class="cart-footer p-4 shadow-sm rounded-4 bg-white border d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h5>Sous-total : <strong>{{ number_format($grandTotal,2) }} DT</strong></h5>
                <h4 class="fw-bold">Total : {{ number_format($grandTotal,2) }} DT</h4>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg px-4 shadow-lg">
                <i class="bi bi-credit-card me-2"></i> Finaliser la commande
                <span class="badge bg-light text-dark ms-2">{{ number_format($grandTotal, 2) }} DT</span>
            </a>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.increment, .decrement').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            let value = parseInt(input.value);
            if(this.classList.contains('increment')) value++;
            else if(value > 1) value--;
            input.value = value;
        });
    });
});
</script>

<style>
.cart-header, .cart-footer { backdrop-filter: blur(15px); }
.cart-table-container table th, .cart-table-container table td { vertical-align: middle; }
.product-image-placeholder { font-size: 1.5rem; }
.empty-cart { transition: transform 0.3s; }
.empty-cart:hover { transform: scale(1.02); }

/* BOUTON UPDATE HORIZONTAL & PETIT */
.update-btn {
    width: 35px !important;
    height: 35px !important;
    padding: 0 !important;
    border-radius: 6px !important;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
    border: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.update-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}
</style>
@endsection
