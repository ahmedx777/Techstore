@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="main-container">
    <!-- Header Dashboard -->
    <div class="dashboard-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="dashboard-title">
                    <i class="bi bi-speedometer2 me-3 text-primary"></i>
                    Dashboard Admin
                </h1>
                <p class="dashboard-subtitle mb-0">Gérez efficacement vos produits, catégories et commandes</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="bi bi-shop me-2"></i>
                    Retour au site
                </a>
            </div>
        </div>
    </div>

    <!-- Stats rapides -->
    <div class="row mb-5 g-4">
        <div class="col-md-4 col-sm-6">
            <div class="stat-card products-card">
                <div class="stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ \App\Models\Product::count() }}</h3>
                    <p class="stat-label">Produits</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <div class="stat-card categories-card">
                <div class="stat-icon">
                    <i class="bi bi-grid-3x3-gap"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ \App\Models\Category::count() }}</h3>
                    <p class="stat-label">Catégories</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-6">
            <div class="stat-card orders-card">
                <div class="stat-icon">
                    <i class="bi bi-bag-check"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-number">{{ \App\Models\Order::count() ?? 0 }}</h3>
                    <p class="stat-label">Commandes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions principales -->
    <div class="row g-4">
        <!-- Produits -->
        <div class="col-lg-4 col-md-6">
            <div class="action-card products-action">
                <div class="action-header">
                    <i class="bi bi-box-seam-fill action-icon"></i>
                    <h4>Produits</h4>
                </div>
                <p class="action-desc">Gérez le catalogue de votre boutique</p>
                <div class="action-buttons">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="bi bi-plus-circle me-2"></i>
                        Ajouter produit
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary btn-lg w-100">
                        <i class="bi bi-list-ul me-2"></i>
                        Gérer produits
                    </a>
                </div>
            </div>
        </div>

        <!-- Catégories -->
        <div class="col-lg-4 col-md-6">
            <div class="action-card categories-action">
                <div class="action-header">
                    <i class="bi bi-grid-fill action-icon"></i>
                    <h4>Catégories</h4>
                </div>
                <p class="action-desc">Organisez vos produits par catégories</p>
                <div class="action-buttons">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-info btn-lg w-100 mb-2">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nouvelle catégorie
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-info btn-lg w-100">
                        <i class="bi bi-list-ul me-2"></i>
                        Gérer catégories
                    </a>
                </div>
            </div>
        </div>

        <!-- Commandes -->
        <div class="col-lg-4 col-md-12">
            <div class="action-card orders-action">
                <div class="action-header">
                    <i class="bi bi-cart-check-fill action-icon"></i>
                    <h4>Commandes</h4>
                </div>
                <p class="action-desc">Suivez et gérez les commandes clients</p>
                <div class="action-buttons">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-warning btn-lg w-100">
                        <i class="bi bi-list-check me-2"></i>
                        Voir toutes les commandes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Header Dashboard */
.dashboard-header {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.3);
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1.2;
}

.dashboard-subtitle {
    font-size: 1.2rem;
    color: #64748b;
    font-weight: 500;
}

/* Stats Cards */
.stat-card {
    background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 48px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    flex-shrink: 0;
}

.products-card .stat-icon { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.categories-card .stat-icon { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
.orders-card .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin: 0;
    line-height: 1;
}

.stat-label {
    color: #64748b;
    font-size: 1rem;
    font-weight: 600;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Action Cards */
.action-card {
    background: #fff;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    position: relative;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    opacity: 0.7;
}

.products-action::before { background: linear-gradient(90deg, #10b981, #059669); }
.categories-action::before { background: linear-gradient(90deg, #3b82f6, #1d4ed8); }
.orders-action::before { background: linear-gradient(90deg, #f59e0b, #d97706); }

.action-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 24px 64px rgba(0,0,0,0.15);
}

.action-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.action-icon {
    font-size: 2.5rem;
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.products-action .action-icon { 
    background: linear-gradient(135deg, #10b981, #059669); 
    color: white; 
}
.categories-action .action-icon { 
    background: linear-gradient(135deg, #3b82f6, #1d4ed8); 
    color: white; 
}
.orders-action .action-icon { 
    background: linear-gradient(135deg, #f59e0b, #d97706); 
    color: white; 
}

.action-header h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.action-desc {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.action-buttons .btn {
    border-radius: 16px;
    padding: 1rem 1.5rem;
    font-weight: 600;
    font-size: 1rem;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-header {
        padding: 2rem 1.5rem;
        text-align: center;
    }
    
    .dashboard-title {
        font-size: 2rem;
    }
    
    .action-card {
        padding: 2rem 1.5rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
}
</style>
@endsection
