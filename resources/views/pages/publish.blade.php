@extends('layouts.maskan')
@section('title', 'MaskanTech — Publier une annonce')

@section('styles')
.publish-wrap { max-width: 900px; margin: 0 auto; padding: 60px 48px; }
.publish-header { margin-bottom: 40px; }
.publish-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
.publish-subtitle { font-size: 15px; color: #888; line-height: 1.7; }
.publish-card { background: #fff; border: 1px solid #ede9e3; border-radius: 16px; padding: 32px; margin-bottom: 24px; }
.publish-card-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
.publish-card-sub { font-size: 13px; color: #888; margin-bottom: 24px; }
.photo-upload {
    border: 2px dashed #e8e3db; border-radius: 12px;
    padding: 40px; text-align: center; cursor: pointer;
    transition: border-color 0.2s; background: #fafaf8;
}
.photo-upload:hover { border-color: #C8873A; }
.photo-upload-icon { font-size: 40px; margin-bottom: 12px; }
.photo-upload-text { font-size: 14px; color: #888; }
.photo-upload-text span { color: #C8873A; font-weight: 500; }
.amenities-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 10px; }
.amenity-item {
    padding: 12px; border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; text-align: center; cursor: pointer;
    transition: all 0.2s; background: #fff;
}
.amenity-item:hover { border-color: #C8873A; background: #fdf6ee; }
.amenity-item.selected { border-color: #C8873A; background: #fdf6ee; color: #C8873A; font-weight: 500; }
.student-option {
    display: flex; align-items: center; justify-content: space-between;
    background: #f0f7ff; border: 1.5px solid #b8d4f0;
    border-radius: 10px; padding: 16px 20px; cursor: pointer; transition: all 0.2s;
}
.student-option.active { background: #185FA5; border-color: #185FA5; }
.student-option-left { display: flex; align-items: center; gap: 14px; }
.student-option-text { font-size: 14px; font-weight: 500; color: #185FA5; }
.student-option.active .student-option-text { color: #fff; }
.student-option-desc { font-size: 12px; color: #888; margin-top: 3px; }
.student-option.active .student-option-desc { color: rgba(255,255,255,0.7); }
.toggle-switch {
    width: 40px; height: 22px; background: #b8d4f0;
    border-radius: 11px; position: relative; transition: background 0.2s; flex-shrink: 0;
}
.student-option.active .toggle-switch { background: #fff; }
.toggle-switch::after {
    content: ''; position: absolute; top: 3px; left: 3px;
    width: 16px; height: 16px; border-radius: 50%;
    background: #185FA5; transition: transform 0.2s;
}
.student-option.active .toggle-switch::after { transform: translateX(18px); }
.publish-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px; }
.publish-submit {
    padding: 14px 32px; background: #1a1a1a; color: #fff;
    border: none; border-radius: 8px; font-size: 15px; font-weight: 500;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s;
}
.publish-submit:hover { background: #C8873A; }
.publish-save {
    padding: 14px 24px; background: transparent; color: #888;
    border: 1.5px solid #e8e3db; border-radius: 8px; font-size: 14px;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.publish-save:hover { border-color: #C8873A; color: #C8873A; }
.alert-error { background:#fff0f0;border:1px solid #ffcccc;color:#cc0000;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px;line-height:1.6; }
@endsection

@section('content')
<div class="publish-wrap">

    <div class="publish-header">
        <div class="mk-section-tag">Publier une annonce</div>
        <div class="publish-title">Décrivez votre bien</div>
        <p class="publish-subtitle">Remplissez les informations ci-dessous pour publier votre annonce gratuitement.</p>
    </div>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($property)) @method('PUT') @endif

        {{-- INFOS GÉNÉRALES --}}
        <div class="publish-card">
            <div class="publish-card-title">Informations générales</div>
            <div class="publish-card-sub">Décrivez votre bien en détail pour attirer les bons locataires.</div>

            <div class="mk-form-group">
                <label>Titre de l'annonce</label>
                <input type="text" name="title" value="{{ old('title', $property->title ?? '') }}"
                    placeholder="Ex: Studio meublé — Guéliz, Marrakech" required>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Type de bien</label>
                    <select name="type" required>
                        <option value="">Choisir un type</option>
                        @foreach(['apartment'=>'Appartement','studio'=>'Studio','house'=>'Maison / Villa','room'=>'Chambre','colocation'=>'Colocation'] as $val => $label)
                            <option value="{{ $val }}" {{ old('type', $property->type ?? '') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Loyer mensuel (MAD)</label>
                    <input type="number" name="price" value="{{ old('price', $property->price ?? '') }}"
                        placeholder="Ex: 2500" required>
                </div>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Ville</label>
                    <select name="city" required>
                        <option value="">Choisir une ville</option>
                        @foreach(['Marrakech','Casablanca','Rabat','Fès','Agadir','Tanger','Meknès','Oujda'] as $ville)
                            <option value="{{ $ville }}" {{ old('city', $property->city ?? '') === $ville ? 'selected' : '' }}>{{ $ville }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Code postal</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $property->postal_code ?? '') }}"
                        placeholder="Ex: 40000">
                </div>
            </div>

            <div class="mk-form-group">
                <label>Adresse complète</label>
                <input type="text" name="address" value="{{ old('address', $property->address ?? '') }}"
                    placeholder="Ex: 12 Rue Mohammed V, Guéliz" required>
            </div>

            <div class="mk-form-group">
                <label>Description</label>
                <textarea name="description" rows="5"
                    placeholder="Décrivez votre bien : ambiance, proximité des transports, commerces...">{{ old('description', $property->description ?? '') }}</textarea>
            </div>
        </div>

        {{-- DÉTAILS --}}
        <div class="publish-card">
            <div class="publish-card-title">Détails du logement</div>
            <div class="publish-card-sub">Informations techniques sur votre bien.</div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Surface (m²)</label>
                    <input type="number" name="area" value="{{ old('area', $property->area ?? '') }}"
                        placeholder="Ex: 35">
                </div>
                <div class="mk-form-group">
                    <label>Nombre de pièces</label>
                    <input type="number" name="rooms" value="{{ old('rooms', $property->rooms ?? '') }}"
                        placeholder="Ex: 3" min="1">
                </div>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Chambres</label>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms ?? '') }}"
                        placeholder="Ex: 2" min="0">
                </div>
                <div class="mk-form-group">
                    <label>Salles de bain</label>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms ?? '') }}"
                        placeholder="Ex: 1" min="1">
                </div>
            </div>
        </div>

        {{-- PHOTOS --}}
        <div class="publish-card">
            <div class="publish-card-title">Photos du logement</div>
            <div class="publish-card-sub">Ajoutez jusqu'à 10 photos. La première sera la photo principale.</div>

            <div class="photo-upload" onclick="document.getElementById('photos').click()">
                <div class="photo-upload-icon">📷</div>
                <div class="photo-upload-text">
                    Glissez vos photos ici ou <span>cliquez pour parcourir</span>
                </div>
                <div style="font-size:12px;color:#aaa;margin-top:8px;">JPG, PNG — Max 5MB par photo</div>
                <div id="photo-names" style="margin-top:12px;font-size:13px;color:#C8873A;"></div>
            </div>
            <input type="file" id="photos" name="images[]" multiple accept="image/*"
                style="display:none;" onchange="showPhotoNames(this)">
        </div>

        {{-- ÉQUIPEMENTS --}}
        <div class="publish-card">
            <div class="publish-card-title">Équipements</div>
            <div class="publish-card-sub">Sélectionnez les équipements disponibles.</div>

            <div class="amenities-grid">
                @foreach($features as $feature)
                    <div class="amenity-item {{ collect(old('features', isset($property) ? $property->features->pluck('id')->toArray() : []))->contains($feature->id) ? 'selected' : '' }}"
                         onclick="toggleAmenity(this, {{ $feature->id }})">
                        {{ $feature->name }}
                        <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                            style="display:none;"
                            {{ collect(old('features', isset($property) ? $property->features->pluck('id')->toArray() : []))->contains($feature->id) ? 'checked' : '' }}>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- OPTION ÉTUDIANT --}}
        <div class="publish-card">
            <div class="publish-card-title">Options spéciales</div>
            <div class="publish-card-sub">Paramètres supplémentaires pour votre annonce.</div>

            <input type="hidden" name="target_audience" id="target_audience"
                value="{{ old('target_audience', $property->target_audience ?? 'all') }}">

            <div class="student-option {{ old('target_audience', $property->target_audience ?? 'all') === 'student' ? 'active' : '' }}"
                 id="studentOption" onclick="toggleStudent()">
                <div class="student-option-left">
                    <span style="font-size:24px;">🎓</span>
                    <div>
                        <div class="student-option-text">Réserver aux étudiants</div>
                        <div class="student-option-desc">Seuls les étudiants vérifiés pourront contacter pour cette annonce</div>
                    </div>
                </div>
                <div class="toggle-switch" id="studentSwitch"></div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="publish-actions">
            <a href="{{ route('dashboard') }}" class="publish-save">Annuler</a>
            <button type="submit" class="publish-submit">
                {{ isset($property) ? 'Mettre à jour →' : "Publier l'annonce →" }}
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
    function toggleAmenity(el, id) {
        el.classList.toggle('selected');
        const cb = el.querySelector('input[type=checkbox]');
        cb.checked = !cb.checked;
    }

    function toggleStudent() {
        const opt = document.getElementById('studentOption');
        const input = document.getElementById('target_audience');
        opt.classList.toggle('active');
        input.value = opt.classList.contains('active') ? 'student' : 'all';
    }

    function showPhotoNames(input) {
        const names = Array.from(input.files).map(f => '✅ ' + f.name).join('<br>');
        document.getElementById('photo-names').innerHTML = names;
    }
</script>
@endsection