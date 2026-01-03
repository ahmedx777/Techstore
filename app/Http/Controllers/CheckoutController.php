<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Récupérer le panier depuis la session
        $cart = session('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        // Validation des champs du formulaire de livraison
        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        // Vérification du stock avant de créer la commande
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', "Stock insuffisant pour le produit : {$item['name']}");
            }
        }

        // Créer la commande avec toutes les infos de livraison
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'fullname' => $request->fullname,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
        ]);

        // Créer les items de la commande et mettre à jour le stock
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            // Décrémenter le stock du produit
            $product = Product::find($productId);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Vider le panier
        session()->forget('cart');

        // Redirection vers la page de détails de la commande avec message de confirmation
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Commande passée avec succès !');
    }
}