@extends('layouts.maskan')
@section('title', isset($property) ? 'Modifier l\'annonce — MaskanTech' : 'Nouvelle annonce — MaskanTech')

@section('styles')
.form-wrap { max-width: 780px; margin: 0 auto; padding: 40px 24px; }

/* Breadcrumb */
.breadcrumb { font-size: 12px; color: #888; display: flex; align-items: center; gap: 8px; margin-bottom: 28px; }
.breadcrumb a { color: #888; text-decoration: none; transition: color 0.2s; }
.breadcrumb a:hover { color: #C8873A; }

/* Section card */
.form-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 28px; margin-bottom: 20px; }
.form-card-title { font-size: 11px; color: #aaa; letter-spacing: 2px; text-transform: uppercase; font-weight: 500; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f5f2ee; }

/* Grid */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-grid .col-2 { grid-column: 1 / -1; }
@media(max-width: 640px) { .form-grid { grid-template-columns: 1fr; } .form-grid .col-2 { grid-column: 1; } }

/* Champs */
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-label { font-size: 12px; color: #555; font-weight: 500; }
.form-label .req { color: #C8873A; }
.form-input,
.form-select,
.form-textarea {
    padding: 11px 14px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; font-family: 'DM Sans', sans-serif;
    color: #1a1a1a; outline: none; transition: border-color 0.2s;
    background: #fff; width: 100%; box-sizing: border-box;
}
.form-input:focus,
.form-select:focus,
.form-textarea:focus { border-color: #C8873A; }
.form-input.error,
.form-select.error { border-color: #ef4444; }
.form-error { font-size: 11px; color: #ef4444; }
.form-hint { font-size: 11px; color: #aaa; }
.form-textarea { resize: vertical; min-height: 100px; }

/* Checkbox */
.form-check { display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13px; color: #555; }
.form-check input[type="checkbox"] { width: 16px; height: 16px; accent-color: #C8873A; cursor: pointer; }

/* Features grid */
.features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
@media(max-width: 640px) { .features-grid { grid-template-columns: repeat(2, 1fr); } }

/* Images existantes */
.existing-images { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px; }
.existing-img { position: relative; width: 80px; height: 60px; border-radius: 8px; overflow: hidden; border: 1.5px solid #ede9e3; }
.existing-img img { width: 100%; height: 100%; object-fit: cover; }
.existing-img .primary-tag { position: absolute; bottom: 0; left: 0; right: 0; text-align: center; font-size: 9px; background: #C8873A; color: #fff; padding: 2px; }
.file-input { width: 100%; font-size: 13px; color: #555; }
.file-input::file-selector-button { padding: 8px 14px; background: #f5f2ee; border: 1.5px solid #e8e3db; border-radius: 6px; font-size: 12px; font-family: 'DM Sans', sans-serif; cursor: pointer; margin-right: 10px; transition: all 0.2s; }
.file-input::file-selector-button:hover { background: #C8873A; color: #fff; border-color: #C8873A; }

/* Actions */
.form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px; }
.btn-cancel {
    padding: 11px 20px; border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; color: #555; text-decoration: none;
    transition: all 0.2s; background: transparent; cursor: pointer;
    font-family: 'DM Sans', sans-serif;
}
.btn-cancel:hover { border-color: #C8873A; color: #C8873A; }
.btn-submit {
    padding: 11px 28px; background: #1a1a1a; color: #fff;
    border: none; border-radius: 8px; font-size: 13px; font-weight: 600;
    cursor: pointer; font-family: 'DM Sans', sans-serif;
    transition: background 0.2s;
}
.btn-submit:hover { background: #C8873A; }
@endsection

@section('content')
<div class="form-wrap">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('properties.index') }}">Biens</a>
        <span>/</span>
        <span style="color:#1a1a1a">{{ isset($property) ? 'Modifier l\'annonce' : 'Nouvelle annonce' }}</span>
    </div>

    <form method="POST"
          action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}"
          enctype="multipart/form-data">
        @csrf
        @isset($property) @method('PUT') @endisset

        {{-- 1. INFORMATIONS PRINCIPALES --}}
        <div class="form-card">
            <div class="form-card-title">Informations principales</div>
            <div class="form-grid">

                <div class="col-2 form-group">
                    <label class="form-label">Titre <span class="req">*</span></label>
                    <input type="text" name="title"
                           value="{{ old('title', $property->title ?? '') }}" required
                           placeholder="Ex : Appartement meublé 2 pièces — Guéliz"
                           class="form-input @error('title') error @enderror">
                    @error('title') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Type <span class="req">*</span></label>
                    <select name="type" required class="form-select">
                        @foreach(['house' => 'Maison', 'apartment' => 'Appartement', 'land' => 'Terrain', 'office' => 'Bureau'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('type', $property->type ?? '') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Statut <span class="req">*</span></label>
                    <select name="status" required class="form-select">
                        <option value="available" {{ old('status', $property->status ?? 'available') === 'available' ? 'selected' : '' }}>Disponible à la location</option>
                        <option value="rented"    {{ old('status', $property->status ?? '') === 'rented' ? 'selected' : '' }}>Loué</option>
                    </select>
                </div>

                <div class="col-2 form-group">
                    <label class="form-label">Audience cible <span class="req">*</span></label>
                    <select name="target_audience" required class="form-select">
                        @foreach(\App\Models\Property::AUDIENCES as $val => $lbl)
                        <option value="{{ $val }}" {{ old('target_audience', $property->target_audience ?? 'all') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    <span class="form-hint">Définit qui peut voir cette annonce dans les résultats.</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Loyer mensuel (MAD) <span class="req">*</span></label>
                    <input type="number" name="price"
                           value="{{ old('price', $property->price ?? '') }}" required min="0"
                           placeholder="3500"
                           class="form-input @error('price') error @enderror">
                    @error('price') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Surface (m²)</label>
                    <input type="number" name="area"
                           value="{{ old('area', $property->area ?? '') }}"
                           placeholder="65"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Pièces</label>
                    <input type="number" name="rooms" min="0"
                           value="{{ old('rooms', $property->rooms ?? '') }}"
                           placeholder="3"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Chambres</label>
                    <input type="number" name="bedrooms" min="0"
                           value="{{ old('bedrooms', $property->bedrooms ?? '') }}"
                           placeholder="2"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Salles de bain</label>
                    <input type="number" name="bathrooms" min="0"
                           value="{{ old('bathrooms', $property->bathrooms ?? '') }}"
                           placeholder="1"
                           class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Année de construction</label>
                    <input type="number" name="year_built"
                           value="{{ old('year_built', $property->year_built ?? '') }}"
                           min="1900" max="{{ date('Y') }}"
                           placeholder="{{ date('Y') }}"
                           class="form-input">
                </div>

                <div class="col-2 form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-textarea"
                              placeholder="Décrivez le logement : emplacement, équipements, points forts...">{{ old('description', $property->description ?? '') }}</textarea>
                </div>

                <div class="col-2">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $property->is_featured ?? false) ? 'checked' : '' }}>
                        Mettre cette annonce en avant (★ En vedette)
                    </label>
                </div>
            </div>
        </div>

        {{-- 2. LOCALISATION --}}
        <div class="form-card">
            <div class="form-card-title">Localisation</div>
            <div class="form-grid">

                <div class="col-2 form-group">
                    <label class="form-label">Adresse <span class="req">*</span></label>
                    <input type="text" name="address"
                           value="{{ old('address', $property->address ?? '') }}" required
                           placeholder="123 Rue Mohammed V"
                           class="form-input @error('address') error @enderror">
                    @error('address') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Ville <span class="req">*</span></label>
                    <input type="text" name="city"
                           value="{{ old('city', $property->city ?? '') }}" required
                           placeholder="Marrakech"
                           class="form-input @error('city') error @enderror">
                    @error('city') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Code postal</label>
                    <input type="text" name="postal_code"
                           value="{{ old('postal_code', $property->postal_code ?? '') }}"
                           placeholder="40000"
                           class="form-input">
                </div>

                <div class="col-2 form-group">
                    <label class="form-label">Lien vidéo (YouTube, Vimeo…)</label>
                    <input type="url" name="video_url"
                           value="{{ old('video_url', $property->video_url ?? '') }}"
                           placeholder="https://youtube.com/watch?v=..."
                           class="form-input">
                </div>
            </div>
        </div>

        {{-- 3. ÉQUIPEMENTS --}}
        @if(isset($features) && $features->count())
        <div class="form-card">
            <div class="form-card-title">Équipements & Caractéristiques</div>
            <div class="features-grid">
                @foreach($features as $feature)
                <label class="form-check">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                           {{ in_array($feature->id, old('features', $property?->features?->pluck('id')?->toArray() ?? [])) ? 'checked' : '' }}>
                    {{ $feature->name }}
                </label>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 4. PHOTOS --}}
        <div class="form-card">
            <div class="form-card-title">Photos du logement</div>

            @if(isset($property) && $property->images->count())
            <div class="existing-images">
                @foreach($property->images as $img)
                <div class="existing-img">
                    <img src="{{ Storage::url($img->image_path) }}" alt="">
                    @if($img->is_primary)
                    <div class="primary-tag">PRINCIPALE</div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            <div class="form-group">
                <label class="form-label">
                    {{ isset($property) ? 'Ajouter de nouvelles photos' : 'Photos (plusieurs possibles)' }}
                </label>
                <input type="file" name="images[]" multiple accept="image/*" class="file-input">
                <span class="form-hint">JPG, PNG. La première image sera l'image principale.</span>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="form-actions">
            <a href="{{ route('properties.index') }}" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit">
                {{ isset($property) ? '✓ Mettre à jour' : '+ Publier l\'annonce' }}
            </button>
        </div>

    </form>
</div>
@endsection
