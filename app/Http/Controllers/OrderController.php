<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    // Créer une commande depuis le panier
    public function store(Request $request)
    {
        // Validation des champs de livraison
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Panier vide');
        }

        // Créer la commande avec toutes les infos
        $order = Order::create([
            'user_id' => Auth::id(),
            'fullname' => $request->fullname,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'status' => 'pending'
        ]);

        // Créer les items
        foreach ($cart as $product_id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Vider le panier
        Session::forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Commande passée avec succès !');
    }

    // Afficher les commandes
    public function index()
    {
        if (Auth::user()->is_admin) {
            $orders = Order::with(['items.product', 'user'])->latest()->get();
            return view('admin.orders.index', compact('orders')); // vue admin
        } else {
            $orders = Auth::user()->orders()->with('items.product')->latest()->get();
            return view('orders.index', compact('orders')); // vue utilisateur
        }
    }

    // Afficher détails d'une commande
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // Sécurité : seul l’admin ou le propriétaire peut voir
        if (!Auth::user()->is_admin && $order->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        return view('orders.show', compact('order'));
    }
}