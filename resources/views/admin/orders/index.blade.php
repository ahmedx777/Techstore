@extends('layouts.app')
@section('title', 'Toutes les commandes')

@section('content')
<style>
.page-header {
    background: white;
    border-radius: 15px;
    padding: 2.5rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    border: 1px solid #f8f9fa;
    margin-bottom: 2.5rem;
}

.page-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #0d6efd;
    margin: 0 0 0.5rem 0;
}

.page-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    margin: 0;
}

.stats-badge .badge {
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    background: linear-gradient(135deg, #ffc107, #fbbf24);
    color: #000;
    font-weight: 600;
}

.table-container {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    border: 1px solid #f8f9fa;
}

.orders-table {
    width: 100%;
    margin: 0;
}

.orders-table thead th {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: white;
    font-weight: 700;
    padding: 1.25rem 1rem;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    white-space: nowrap;
}

.orders-table tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-color: #f8f9fa;
}

.order-row {
    transition: all 0.3s ease;
}

.order-row:hover {
    background: rgba(13, 110, 253, 0.05);
}

.order-id {
    font-weight: 700;
    color: #0d6efd;
    font-size: 1.1rem;
}

.client-name {
    font-weight: 600;
    color: #1a1a1a;
}

.client-email {
    color: #6c757d;
    font-size: 0.95rem;
}

.order-total {
    color: #0d6efd;
    font-weight: 700;
    font-size: 1.1rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: capitalize;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-badge.confirmed {
    background: #d1edff;
    color: #0d6efd;
    border: 1px solid #0d6efd;
}

.status-badge.shipped {
    background: #d4edda;
    color: #155724;
    border: 1px solid #28a745;
}

.status-badge.delivered {
    background: #e2e8f0;
    color: #1a202c;
    border: 1px solid #4a5568;
}

.status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.order-date {
    white-space: nowrap;
}

.order-date small {
    opacity: 0.7;
}

.order-actions .btn {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 1px solid #0d6efd;
    color: #0d6efd;
}

.order-actions .btn:hover {
    background: #0d6efd;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
}

.empty-state {
    padding: 4rem 2rem;
    text-align: center;
    color: #6c757d;
}

.empty-state i {
    opacity: 0.5;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.8rem;
    }
    .orders-table thead {
        display: none;
    }
    .order-row {
        display: block;
        margin-bottom: 1rem;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .order-row td {
        display: block;
        padding: 0.5rem 0;
        border: none;
        position: relative;
        padding-left: 50%;
    }
    .order-row td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        font-weight: 600;
        color: #0d6efd;
        font-size: 0.9rem;
    }
}
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="page-title">
                    <i class="bi bi-bag-check-fill me-3" style="color: #ffc107;"></i>
                    Toutes les commandes
                </h1>
                <p class="page-subtitle mb-0">
                    {{ $orders->count() }} commande{{ $orders->count() > 1 ? 's' : '' }} trouvée{{ $orders->count() > 1 ? 's' : '' }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="stats-badge">
                    <span class="badge">
                        <i class="bi bi-currency-exchange me-2"></i>
                        {{ number_format($orders->sum('total_price'), 2) }} DT total
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="table-container">
        <div class="table-responsive">
            <table class="table orders-table mb-0">
                <thead>
                    <tr>
                        <th><i class="bi bi-hash me-1"></i>ID</th>
                        <th><i class="bi bi-person me-1"></i>Client</th>
                        <th><i class="bi bi-envelope me-1"></i>Email</th>
                        <th><i class="bi bi-currency-exchange me-1"></i>Total</th>
                        <th><i class="bi bi-circle-fill me-1"></i>Statut</th>
                        <th><i class="bi bi-calendar me-1"></i>Date</th>
                        <th><i class="bi bi-eye me-1"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="order-row">
                            <td class="order-id" data-label="ID">#{{ $order->id }}</td>
                            <td class="client-name" data-label="Client">{{ $order->fullname }}</td>
                            <td class="client-email" data-label="Email">{{ $order->user->email ?? '—' }}</td>
                            <td class="order-total" data-label="Total">
                                {{ number_format($order->total_price, 2) }} DT
                            </td>
                            <td class="order-status" data-label="Statut">
                                <span class="status-badge {{ $order->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="order-date" data-label="Date">
                                <div>{{ $order->created_at->format('d/m/Y') }}</div>
                                <small>{{ $order->created_at->format('H:i') }}</small>
                            </td>
                            <td class="order-actions" data-label="Actions">
                                <a href="{{ route('orders.show', $order->id) }}" 
                                   class="btn view-btn" 
                                   title="Voir les détails">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-inbox display-3 mb-4"></i>
                                    <h5>Aucune commande trouvée</h5>
                                    <p class="mb-0">Commencez par ajouter vos premières commandes</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($orders, 'hasPages') && $orders->hasPages())
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>

@endsection
