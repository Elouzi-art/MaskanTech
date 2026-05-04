<?php
// ════════════════════════════════════════════════════════════════════════════
//  app/Http/Controllers/FavoriteController.php
// ════════════════════════════════════════════════════════════════════════════
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /** Toggle favori */
    public function toggle(Property $property)
    {
        Auth::user()->favorites()->toggle($property->id);
        return back()->with('success', 'Favoris mis à jour.');
    }

    /** Page mes favoris (client) */
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('primaryImage')->paginate(12);
        return view('favorites.index', compact('favorites'));
    }
}
