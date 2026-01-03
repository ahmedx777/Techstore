@extends('layouts.app')
@section('title','My Orders')

@section('content')
<div class="container my-4">
    <h2 class="fw-bold text-primary mb-4"><i class="bi bi-bag-check"></i> Mes Commandes</h2>

    @forelse($orders as $order)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">
                        Order #{{ $order->id }}
                        <span class="badge 
                            @if($order->status === 'pending') bg-warning text-dark
                            @elseif($order->status === 'completed') bg-success
                            @elseif($order->status === 'cancelled') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </h5>
                    <small class="text-muted">{{ $order->created_at->format('Y-m-d') }}</small>
                </div>

                <p class="mt-2 mb-3">
                    <strong class="text-success">{{ number_format($order->total_price,2) }} DT</strong>
                </p>

                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-eye"></i> Voir Détails
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> You have no orders yet.
        </div>
    @endforelse
</div>
@endsection