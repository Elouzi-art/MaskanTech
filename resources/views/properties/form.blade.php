@extends('layouts.app')
@section('title', isset($property) ? 'Modifier l\'annonce' : 'Nouvelle annonce')

@section('content')
<div class="p-4 max-w-3xl mx-auto">

    <div class="flex items-center gap-2 text-[10px] text-dark-muted tracking-wider mb-4">
        <a href="{{ route('properties.index') }}" class="hover:text-dark-text transition-colors">LOGEMENTS</a>
        <span class="text-dark-dim">/</span>
        <span class="text-dark-text">{{ isset($property) ? 'MODIFIER' : 'NOUVELLE ANNONCE' }}</span>
    </div>

    <form method="POST"
          action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}"
          enctype="multipart/form-data"
          class="flex flex-col gap-4">
        @csrf
        @isset($property) @method('PUT') @endisset

        {{-- Section: Informations principales --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Informations principales</div>
            <div class="grid grid-cols-2 gap-3">

                <div class="col-span-2">
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $property->title ?? '') }}" required
                           class="w-full bg-dark-card3 border @error('title') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                    @error('title') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Type *</label>
                    <select name="type" required class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                        @foreach(['house' => 'Maison', 'apartment' => 'Appartement', 'land' => 'Terrain', 'office' => 'Bureau'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('type', $property->type ?? '') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Statut *</label>
                    <select name="status" required class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                        {{-- Location uniquement — pas de vente --}}
                        <option value="available" {{ old('status', $property->status ?? 'available') === 'available' ? 'selected' : '' }}>Disponible à la location</option>
                        <option value="rented"    {{ old('status', $property->status ?? '') === 'rented'    ? 'selected' : '' }}>Loué</option>
                    </select>
                </div>

                {{-- Audience cible --}}
                <div class="col-span-2">
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Audience cible *</label>
                    <select name="target_audience" required class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                        @foreach(\App\Models\Property::AUDIENCES as $val => $lbl)
                        <option value="{{ $val }}" {{ old('target_audience', $property->target_audience ?? 'all') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-dark-dim mt-1">Définit qui peut voir cette annonce : étudiants, professionnels, ou tout le monde.</p>
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Loyer mensuel (MAD) *</label>
                    <input type="number" name="price" value="{{ old('price', $property->price ?? '') }}" required min="0"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                    @error('price') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Surface (m²)</label>
                    <input type="number" name="area" value="{{ old('area', $property->area ?? '') }}"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Pièces</label>
                    <input type="number" name="rooms" value="{{ old('rooms', $property->rooms ?? '') }}" min="0"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Chambres</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms ?? '') }}" min="0"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Salles de bain</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms ?? '') }}" min="0"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Année de construction</label>
                    <input type="number" name="year_built" value="{{ old('year_built', $property->year_built ?? '') }}" min="1900" max="{{ date('Y') }}"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono resize-none">{{ old('description', $property->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="flex items-center gap-2 text-[10px] text-dark-muted tracking-wider cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $property->is_featured ?? false) ? 'checked' : '' }}
                               class="accent-indigo-500">
                        Mettre en avant
                    </label>
                </div>
            </div>
        </div>

        {{-- Section: Localisation --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Localisation</div>
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Adresse *</label>
                    <input type="text" name="address" value="{{ old('address', $property->address ?? '') }}" required
                           class="w-full bg-dark-card3 border @error('address') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                    @error('address') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Ville *</label>
                    <input type="text" name="city" value="{{ old('city', $property->city ?? '') }}" required
                           class="w-full bg-dark-card3 border @error('city') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                    @error('city') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Code postal</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $property->postal_code ?? '') }}"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>
            </div>
        </div>

        {{-- Section: Caractéristiques --}}
        @if(isset($features) && $features->count())
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Équipements & Caractéristiques</div>
            <div class="grid grid-cols-2 gap-2">
                @foreach($features as $feature)
                <label class="flex items-center gap-2 text-[10px] text-dark-muted tracking-wider cursor-pointer hover:text-dark-text transition-colors">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           {{ in_array($feature->id, old('features', $property?->features?->pluck('id')?->toArray() ?? [])) ? 'checked' : '' }}
                           class="accent-indigo-500">
                    {{ $feature->name }}
                </label>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Section: Images --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Photos du logement</div>

            @if(isset($property) && $property->images->count())
            <div class="flex gap-2 flex-wrap mb-3">
                @foreach($property->images as $img)
                <div class="relative">
                    <img src="{{ Storage::url($img->image_path) }}" class="w-16 h-16 object-cover rounded-sm border border-dark-border">
                    @if($img->is_primary)
                        <span class="absolute bottom-0 left-0 right-0 text-center text-[8px] bg-indigo-900 text-indigo-300 py-0.5">PRINCIPALE</span>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <label class="block text-[10px] text-dark-muted tracking-wider mb-1">
                {{ isset($property) ? 'Ajouter des photos' : 'Photos (plusieurs possibles)' }}
            </label>
            <input type="file" name="images[]" multiple accept="image/*"
                   class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm font-mono file:bg-dark-card2 file:border-0 file:text-dark-muted file:text-xs file:mr-2 file:px-2 file:py-1">
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 justify-end">
            <a href="{{ route('properties.index') }}"
               class="text-xs text-dark-muted border border-dark-border px-4 py-2 rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors tracking-wider font-mono">
                ANNULER
            </a>
            <button type="submit"
                    class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                {{ isset($property) ? 'METTRE À JOUR' : 'PUBLIER L\'ANNONCE' }}
            </button>
        </div>
    </form>
</div>
@endsection
