<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // afficher favoris
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('product')->get();
        return view('favorites.index', compact('favorites'));
    }

    // ajouter favori
    public function add($product_id)
    {
        Auth::user()->favorites()->firstOrCreate(['product_id' => $product_id]);
        return redirect()->back()->with('success','Produit ajouté aux favoris');
    }

    // supprimer favori
    public function remove($product_id)
    {
        Auth::user()->favorites()->where('product_id', $product_id)->delete();
        return redirect()->back()->with('success','Produit supprimé des favoris');
    }
}
