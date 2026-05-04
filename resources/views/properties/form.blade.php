@extends('layouts.app')
@section('title', isset($property) ? 'Modifier le bien' : 'Nouveau bien')

@section('content')
<div class="p-4 max-w-3xl mx-auto">

    <div class="flex items-center gap-2 text-[10px] text-dark-muted tracking-wider mb-4">
        <a href="{{ route('properties.index') }}" class="hover:text-dark-text transition-colors">BIENS</a>
        <span class="text-dark-dim">/</span>
        <span class="text-dark-text">{{ isset($property) ? 'MODIFIER' : 'NOUVEAU BIEN' }}</span>
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
                        @foreach(['available' => 'Disponible', 'sold' => 'Vendu', 'rented' => 'Loué', 'under_construction' => 'En construction'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('status', $property->status ?? 'available') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Prix (MAD) *</label>
                    <input type="number" name="price" value="{{ old('price', $property->price ?? '') }}" required min="0"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
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
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Description *</label>
                    <textarea name="description" rows="4" required
                              class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono resize-none">{{ old('description', $property->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Vidéo (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $property->video_url ?? '') }}"
                           placeholder="https://youtube.com/..."
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono">
                </div>

                <div class="flex items-center gap-2 self-end pb-2">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                           {{ old('is_featured', $property->is_featured ?? false) ? 'checked' : '' }}
                           class="accent-indigo-500">
                    <label for="is_featured" class="text-xs text-dark-muted cursor-pointer">Mettre en vedette</label>
                </div>

            </div>
        </div>

        {{-- Section: Adresse --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Localisation</div>
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-2">
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Adresse *</label>
                    <input type="text" name="address" value="{{ old('address', $property->address ?? '') }}" required
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>
                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Ville *</label>
                    <input type="text" name="city" value="{{ old('city', $property->city ?? '') }}" required
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>
                <div>
                    <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Code postal</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $property->postal_code ?? '') }}"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                </div>
            </div>
        </div>

        {{-- Section: Photos --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Photos</div>
            <input type="file" name="images[]" multiple accept="image/*"
                   class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono file:mr-3 file:text-[10px] file:bg-dark-card file:border file:border-dark-border file:text-dark-muted file:rounded-sm file:px-2 file:py-1 file:font-mono">
            <p class="text-[10px] text-dark-dim mt-1.5">Formats acceptés : JPG, PNG, WEBP — Max 5MB par image</p>

            @isset($property)
            @if($property->images->count() > 0)
            <div class="flex flex-wrap gap-2 mt-3">
                @foreach($property->images as $img)
                <div class="relative">
                    <img src="{{ Storage::url($img->image_path) }}" class="w-20 h-14 object-cover rounded-sm border border-dark-border">
                    <button type="button" onclick="deleteImage({{ $img->id }}, this)"
                            class="absolute -top-1 -right-1 w-4 h-4 bg-red-900 border border-red-700 text-red-300 rounded-sm text-[9px] flex items-center justify-center hover:bg-red-800">
                        ✕
                    </button>
                </div>
                @endforeach
            </div>
            @endif
            @endisset
        </div>

        {{-- Section: Équipements --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-4">Équipements</div>
            <div class="grid grid-cols-3 gap-2">
                @foreach($features as $feature)
                <label class="flex items-center gap-2 text-xs text-dark-muted cursor-pointer hover:text-dark-text transition-colors">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           {{ (isset($property) && $property->features->contains($feature->id)) || in_array($feature->id, old('features', [])) ? 'checked' : '' }}
                           class="accent-indigo-500">
                    {{ ucfirst($feature->name) }}
                </label>
                @endforeach
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="flex-1 text-xs bg-indigo-950 border border-indigo-700 text-indigo-300 hover:bg-indigo-900 py-2.5 rounded-sm transition-colors tracking-widest font-mono">
                {{ isset($property) ? 'ENREGISTRER LES MODIFICATIONS' : 'PUBLIER LE BIEN' }}
            </button>
            <a href="{{ route('properties.index') }}"
               class="text-xs border border-dark-border text-dark-muted hover:text-dark-text px-6 py-2.5 rounded-sm transition-colors tracking-wider">
                Annuler
            </a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
function deleteImage(id, btn) {
    if (!confirm('Supprimer cette image ?')) return;
    fetch(`/properties/images/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).then(r => r.ok ? btn.parentElement.remove() : alert('Erreur'));
}
</script>
@endpush
