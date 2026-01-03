<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{


public function create()
{
    // Récupérer toutes les catégories pour le select
    $categories = Category::all();
    // Envoyer à la vue
    return view('admin.products.create', compact('categories'));
}
    // afficher liste des produits
    public function index(Request $request)
    {
        $query = Product::with('category');
        // Search
        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }
        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        // Price sort
        if ($request->filled('sort')) {
            $direction = $request->sort === 'desc' ? 'desc' : 'asc';
            $query->orderBy('price', $direction);
        }

        $products = $query->paginate(12)->withQueryString();

        return view('products.index', compact('products'));
    }

    // afficher produit seul (details)
    public function show($id)
    {
        $product = Product::with('reviews.user')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // (admin) créer produit
    public function store(Request $request)
{
    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric',
        'stock'       => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'brand'       => 'nullable|string', 
        'image'       => 'nullable|string', 
    ]);

    Product::create($data);

    return redirect()->route('admin.products.index')->with('success','Produit ajouté');
}
    // (admin) update produit
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->back()->with('success','Produit modifié');
    }

    // (admin) delete produit
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->back()->with('success','Produit supprimé');
    }
    public function adminIndex()
{
    // Récupérer tous les produits avec leur catégorie
    $products = Product::with('category')->paginate(12);

    // Envoyer à la vue admin
    return view('admin.products.index', compact('products'));
}
public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();

    return view('admin.products.edit', compact('product','categories'));
}
    

}