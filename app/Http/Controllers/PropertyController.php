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
            ->filter($request->only(['q', 'type', 'city', 'status', 'price_min', 'price_max', 'bedrooms', 'sort']))
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

        // Caractéristiques
        if ($request->has('features')) {
            $property->features()->sync($request->input('features'));
        }

        // Images
        $this->handleImages($request, $property);

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Bien publié avec succès.');
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
            ->with('success', 'Bien mis à jour.');
    }

    // ── Suppression ───────────────────────────────────────────────────────

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        // Supprimer les fichiers images
        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $property->delete();

        return redirect()
            ->route('properties.index')
            ->with('success', 'Bien supprimé.');
    }

    // ── Incrémenter le compteur de vues (POST AJAX) ───────────────────────

    public function incrementViews(Property $property)
    {
        $property->increment('views_count');
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

            $image = $property->images()->create([
                'image_path'     => $path,
                'is_primary'     => $isFirst && $i === 0,
                'order_position' => $property->images()->count() + $i,
            ]);
        }
    }
}
