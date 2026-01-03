<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // ajouter review
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $data['user_id'] = Auth::id();
        Review::create($data);

        return redirect()->back()->with('success','Avis ajouté');
    }

    // supprimer review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success','Avis supprimé');
    }
}