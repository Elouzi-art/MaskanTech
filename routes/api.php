<?php

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ════════════════════════════════════════════════════════════════════════════
//  API REST — Recherche AJAX
// ════════════════════════════════════════════════════════════════════════════

Route::get('/properties/search', function (Request $request) {
    $properties = Property::with('primaryImage')
        ->filter($request->only(['q', 'type', 'city', 'status', 'price_min', 'price_max', 'bedrooms', 'sort']))
        ->paginate(12);

    return response()->json([
        'data'  => $properties->items(),
        'meta'  => [
            'total'        => $properties->total(),
            'current_page' => $properties->currentPage(),
            'last_page'    => $properties->lastPage(),
        ],
    ]);
});

// Ville autocomplete
Route::get('/cities', function () {
    $cities = Property::select('city')
        ->distinct()
        ->orderBy('city')
        ->pluck('city');

    return response()->json($cities);
});
