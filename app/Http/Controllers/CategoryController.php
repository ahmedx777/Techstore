<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // afficher toutes les catégories (public)
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // afficher produits d'une catégorie (public)
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    // liste des catégories (admin)
    public function adminIndex()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // formulaire création (admin)
    public function create()
    {
        return view('admin.categories.create');
    }

    // enregistrer catégorie (admin)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success','Catégorie ajoutée');
    }

    // formulaire modification (admin)
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // mettre à jour catégorie (admin)
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success','Catégorie modifiée');
    }

    // supprimer catégorie (admin)
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('admin.categories.index')->with('success','Catégorie supprimée');
    }
}