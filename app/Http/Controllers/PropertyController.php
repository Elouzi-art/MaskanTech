<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // ── Liste avec filtres & pagination ───────────────────────────────────

    public function index(Request $request)
    {
        $properties = Property::with(['primaryImage', 'favoritedBy'])
            ->forUser(Auth::user())   // filtre audience selon rôle
            ->filter($request->only(['q', 'type', 'city', 'status', 'price_min', 'price_max', 'bedrooms', 'audience', 'sort']))
            ->paginate(12)
            ->withQueryString();

        return view('properties.index', compact('properties'));
    }

    // ── Formulaire de création ─────────────────────────────────────────────

    public function create()
    {
        $this->authorize('create', Property::class);
        $features = PropertyFeature::orderBy('name')->get();

        return view('properties.form', [
            'property' => null,
            'features' => $features,
        ]);
    }

    // ── Enregistrement d'un nouveau bien ──────────────────────────────────

    public function store(PropertyRequest $request)
    {
        $this->authorize('create', Property::class);

        $property = Auth::user()->properties()->create($request->validated());

        if ($request->has('features')) {
            $property->features()->sync($request->input('features'));
        }

        $this->handleImages($request, $property);

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Annonce publiée avec succès.');
    }

    // ── Détail d'un bien ──────────────────────────────────────────────────

    public function show(Property $property)
    {
        $property->load(['images', 'features', 'user', 'favoritedBy']);

        return view('properties.show', compact('property'));
    }

    // ── Formulaire de modification ────────────────────────────────────────

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        $features = PropertyFeature::orderBy('name')->get();

        return view('properties.form', compact('property', 'features'));
    }

    // ── Mise à jour ───────────────────────────────────────────────────────

    public function update(PropertyRequest $request, Property $property)
    {
        $this->authorize('update', $property);

        $property->update($request->validated());

        if ($request->has('features')) {
            $property->features()->sync($request->input('features'));
        }

        $this->handleImages($request, $property);

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Annonce mise à jour.');
    }

    // ── Suppression ───────────────────────────────────────────────────────

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $property->delete();

        return redirect()
            ->route('properties.index')
            ->with('success', 'Annonce supprimée.');
    }

    // ── Incrémenter le compteur de vues (POST AJAX) ───────────────────────

    public function incrementViews(Property $property)
    {
        $property->increment('views_count');

        // Stocker dans la session pour "récemment consultés"
        $viewed = session('recently_viewed', []);
        $viewed = array_filter($viewed, fn($id) => $id !== $property->id);
        array_unshift($viewed, $property->id);
        session(['recently_viewed' => array_slice($viewed, 0, 10)]);

        return response()->json(['views' => $property->views_count]);
    }

    // ── Gestion des images ────────────────────────────────────────────────

    private function handleImages(Request $request, Property $property): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $isFirst = $property->images()->count() === 0;

        foreach ($request->file('images') as $i => $file) {
            $path = $file->store('properties', 'public');

            $property->images()->create([
                'image_path'     => $path,
                'is_primary'     => $isFirst && $i === 0,
                'order_position' => $property->images()->count() + $i,
            ]);
        }
    }
}
