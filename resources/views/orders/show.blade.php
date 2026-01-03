@extends('layouts.app')
@section('title','Order #' . $order->id)

@section('content')
<div class="container my-5">

    <!-- Confirmation message -->
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold mb-4 shadow-sm border-0" style="border-radius: 15px;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header with gradient -->
    <div class="mb-4 p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <h2 class="fw-bold text-white mb-2">
            <i class="bi bi-receipt-cutoff"></i> Commande #{{ $order->id }}
        </h2>
        <div class="d-inline-block">
            <span class="badge fs-6 px-4 py-2 rounded-pill shadow
                @if($order->status === 'pending') bg-warning text-dark
                @elseif($order->status === 'completed') bg-success
                @elseif($order->status === 'cancelled') bg-danger
                @else bg-light text-dark
                @endif">
                <i class="bi bi-circle-fill me-1" style="font-size: 0.6rem;"></i>
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <!-- Infos de livraison -->
    <div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
        <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
            <h5 class="mb-0 fw-bold"><i class="bi bi-truck me-2"></i>Informations de livraison</h5>
        </div>
        <div class="card-body p-4" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-person-fill text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Nom complet</small>
                            <strong>{{ $order->fullname }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-telephone-fill text-success"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Téléphone</small>
                            <strong>{{ $order->phone }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-geo-alt-fill text-warning"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Adresse</small>
                            <strong>{{ $order->address }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-building text-info"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Ville</small>
                            <strong>{{ $order->city }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-credit-card-fill text-danger"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Méthode de paiement</small>
                            <strong>
                                @if($order->payment_method === 'cash')
                                    💵 Paiement à la livraison
                                @elseif($order->payment_method === 'card')
                                    💳 Carte bancaire
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="card shadow-lg border-0 mb-4 rounded-4 overflow-hidden">
        <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h5 class="mb-0 fw-bold"><i class="bi bi-bag-check-fill me-2"></i>Produits commandés</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="py-3 px-4 border-0">Produit</th>
                            <th class="py-3 px-4 border-0">Prix</th>
                            <th class="py-3 px-4 border-0">Quantité</th>
                            <th class="py-3 px-4 border-0 text-end">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total=0; @endphp
                        @foreach($order->items as $it)
                            @php 
                                $subtotal = $it->price * $it->quantity; 
                                $total += $subtotal; 
                            @endphp
                            <tr style="transition: all 0.3s ease;">
                                <td class="px-4 py-3">
                                    <span class="fw-semibold">{{ $it->product->name }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-normal px-3 py-2">
                                        {{ number_format($it->price,2) }} DT
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary fw-normal px-3 py-2">
                                        ×{{ $it->quantity }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-end">
                                    <span class="fw-bold text-success fs-5">{{ number_format($subtotal,2) }} DT</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Total -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, rgba(13,110,253,0.95), #764ba2 100%);">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-white fw-bold">
                    <i class="bi bi-calculator me-2"></i>Total
                </h3>
                <h2 class="mb-0 text-white fw-bold">
                    {{ number_format($total,2) }} <span style="font-size: 1.2rem;">DT</span>
                </h2>
            </div>
        </div>
    </div>

    <!-- Back button -->
    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-lg btn-outline-primary rounded-pill px-4 shadow-sm" style="transition: all 0.3s ease;">
            <i class="bi bi-arrow-left me-2"></i> Retour aux commandes
        </a>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4) !important;
    }
</style>
@endsection