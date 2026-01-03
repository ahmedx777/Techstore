<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // afficher panier
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

   // ajouter produit au panier
public function add(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = Session::get('cart', []);

    // récupérer la quantité envoyée par le formulaire (par défaut 1)
    $quantity = (int) $request->input('quantity', 1);

    if (isset($cart[$id])) {
        // si le produit existe déjà → on ajoute la quantité demandée
        $cart[$id]['quantity'] += $quantity;
    } else {
        // sinon on initialise avec la quantité demandée
        $cart[$id] = [
            'name'     => $product->name,
            'price'    => $product->price,
            'quantity' => $quantity
        ];
    }

    Session::put('cart', $cart);

    return redirect()->back()->with('success', 'Produit ajouté au panier');
}
    // modifier quantité
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success','Quantité mise à jour');
    }

    // supprimer produit
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success','Produit supprimé du panier');
    }
}