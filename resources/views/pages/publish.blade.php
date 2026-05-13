@extends('layouts.maskan')

@section('title', 'MaskanTech — Publier une annonce')

@section('styles')
.publish-wrap { max-width: 900px; margin: 0 auto; padding: 60px 48px; }

/* HEADER */
.publish-header { margin-bottom: 40px; }
.publish-title {
    font-family: 'Playfair Display', serif;
    font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px;
}
.publish-subtitle { font-size: 15px; color: #888; line-height: 1.7; }

/* STEPS */
.publish-steps {
    display: flex; align-items: center; gap: 0;
    margin-bottom: 40px;
}
.publish-step {
    display: flex; align-items: center; gap: 10px;
    flex: 1;
}
.publish-step-number {
    width: 32px; height: 32px; border-radius: 50%;
    background: #e8e3db; color: #888;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; flex-shrink: 0;
    transition: all 0.2s;
}
.publish-step.active .publish-step-number { background: #C8873A; color: #fff; }
.publish-step.done .publish-step-number { background: #27500A; color: #fff; }
.publish-step-label { font-size: 13px; color: #888; font-weight: 500; }
.publish-step.active .publish-step-label { color: #C8873A; }
.publish-step-line { flex: 1; height: 1px; background: #e8e3db; margin: 0 12px; }

/* CARD */
.publish-card {
    background: #fff; border: 1.5px solid #e8e3db;
    border-radius: 16px; padding: 36px; margin-bottom: 24px;
}
.publish-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 6px;
}
.publish-card-sub { font-size: 13px; color: #888; margin-bottom: 28px; }

/* PHOTO UPLOAD */
.photo-upload {
    border: 2px dashed #e0c99a; border-radius: 12px;
    padding: 40px; text-align: center; cursor: pointer;
    background: #fdf6ee; transition: border-color 0.2s;
    margin-bottom: 16px;
}
.photo-upload:hover { border-color: #C8873A; }
.photo-upload-icon { font-size: 40px; margin-bottom: 12px; }
.photo-upload-text { font-size: 14px; color: #888; }
.photo-upload-text span { color: #C8873A; font-weight: 500; }

/* AMENITIES */
.amenities-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 10px; }
.amenity-item {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 14px; border: 1.5px solid #e8e3db;
    border-radius: 8px; cursor: pointer; transition: all 0.2s;
    font-size: 13px; color: #555;
}
.amenity-item:hover { border-color: #C8873A; color: #C8873A; }
.amenity-item.selected { border-color: #C8873A; background: #fdf6ee; color: #C8873A; }

/* STUDENT TOGGLE */
.student-option {
    display: flex; align-items: center; justify-content: space-between;
    background: #f0f7ff; border: 1.5px solid #b8d4f0;
    border-radius: 10px; padding: 16px 20px; cursor: pointer;
    transition: all 0.2s; margin-bottom: 16px;
}
.student-option.active { background: #185FA5; border-color: #185FA5; }
.student-option-left { display: flex; align-items: center; gap: 12px; }
.student-option-text { font-size: 14px; font-weight: 500; color: #185FA5; }
.student-option.active .student-option-text { color: #fff; }
.student-option-desc { font-size: 12px; color: #888; margin-top: 3px; }
.student-option.active .student-option-desc { color: rgba(255,255,255,0.7); }

/* SUBMIT */
.publish-actions {
    display: flex; gap: 12px; justify-content: flex-end;
    margin-top: 32px;
}
.publish-submit {
    padding: 14px 36px; background: #1a1a1a; color: #fff;
    border: none; border-radius: 8px; font-size: 15px; font-weight: 500;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s;
}
.publish-submit:hover { background: #C8873A; }
.publish-save {
    padding: 14px 24px; background: transparent; color: #888;
    border: 1.5px solid #e8e3db; border-radius: 8px; font-size: 15px;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.publish-save:hover { border-color: #C8873A; color: #C8873A; }
@endsection

@section('content')
<div class="publish-wrap">

    {{-- HEADER --}}
    <div class="publish-header">
        <div class="mk-section-tag">Publier une annonce</div>
        <div class="publish-title">Décrivez votre bien</div>
        <p class="publish-subtitle">Remplissez les informations ci-dessous pour publier votre annonce gratuitement.</p>
    </div>

    {{-- STEPS --}}
    <div class="publish-steps">
        <div class="publish-step active">
            <div class="publish-step-number">1</div>
            <div class="publish-step-label">Informations</div>
        </div>
        <div class="publish-step-line"></div>
        <div class="publish-step">
            <div class="publish-step-number">2</div>
            <div class="publish-step-label">Photos</div>
        </div>
        <div class="publish-step-line"></div>
        <div class="publish-step">
            <div class="publish-step-number">3</div>
            <div class="publish-step-label">Équipements</div>
        </div>
        <div class="publish-step-line"></div>
        <div class="publish-step">
            <div class="publish-step-number">4</div>
            <div class="publish-step-label">Confirmation</div>
        </div>
    </div>

    <form>
        @csrf

        {{-- INFOS GENERALES --}}
        <div class="publish-card">
            <div class="publish-card-title">Informations générales</div>
            <div class="publish-card-sub">Décrivez votre bien en détail pour attirer les bons locataires.</div>

            <div class="mk-form-group">
                <label>Titre de l'annonce</label>
                <input type="text" placeholder="Ex: Studio meublé — Guéliz, Marrakech" required>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Type de bien</label>
                    <select required>
                        <option value="">Choisir un type</option>
                        <option>Appartement</option>
                        <option>Studio</option>
                        <option>Maison / Villa</option>
                        <option>Chambre</option>
                        <option>Colocation</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Loyer mensuel (MAD)</label>
                    <input type="number" placeholder="Ex: 2500" required>
                </div>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Ville</label>
                    <select required>
                        <option value="">Choisir une ville</option>
                        <option>Marrakech</option>
                        <option>Casablanca</option>
                        <option>Rabat</option>
                        <option>Fès</option>
                        <option>Agadir</option>
                        <option>Tanger</option>
                        <option>Meknès</option>
                        <option>Oujda</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Quartier</label>
                    <input type="text" placeholder="Ex: Guéliz, Hivernage...">
                </div>
            </div>

            <div class="mk-form-group">
                <label>Adresse complète</label>
                <input type="text" placeholder="Ex: 12 Rue Mohammed V, Guéliz">
            </div>

            <div class="mk-form-group">
                <label>Description</label>
                <textarea rows="5" placeholder="Décrivez votre bien : ambiance, proximité des transports, commerces, points forts..."></textarea>
            </div>
        </div>

        {{-- DETAILS --}}
        <div class="publish-card">
            <div class="publish-card-title">Détails du logement</div>
            <div class="publish-card-sub">Informations techniques sur votre bien.</div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Surface (m²)</label>
                    <input type="number" placeholder="Ex: 35">
                </div>
                <div class="mk-form-group">
                    <label>Nombre de chambres</label>
                    <select>
                        <option>Studio (0)</option>
                        <option>1 chambre</option>
                        <option>2 chambres</option>
                        <option>3 chambres</option>
                        <option>4+ chambres</option>
                    </select>
                </div>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Salles de bain</label>
                    <select>
                        <option>1</option>
                        <option>2</option>
                        <option>3+</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Étage</label>
                    <select>
                        <option>Rez-de-chaussée</option>
                        <option>1er étage</option>
                        <option>2ème étage</option>
                        <option>3ème étage</option>
                        <option>4ème étage+</option>
                    </select>
                </div>
            </div>

            <div class="mk-form-group">
                <label>Disponible à partir du</label>
                <input type="date">
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
            </div>
            <input type="file" id="photos" multiple accept="image/*" style="display:none;">
        </div>

        {{-- EQUIPEMENTS --}}
        <div class="publish-card">
            <div class="publish-card-title">Équipements</div>
            <div class="publish-card-sub">Sélectionnez les équipements disponibles dans votre logement.</div>

            <div class="amenities-grid">
                <div class="amenity-item" onclick="toggleAmenity(this)">📶 WiFi</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">❄️ Climatisation</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🍳 Cuisine équipée</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🛋️ Meublé</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🔒 Sécurité 24h</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🚗 Parking</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🏊 Piscine</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🌿 Jardin</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🧺 Lave-linge</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">📺 TV</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🔥 Chauffage</div>
                <div class="amenity-item" onclick="toggleAmenity(this)">🛗 Ascenseur</div>
            </div>
        </div>

        {{-- OPTION ETUDIANT --}}
        <div class="publish-card">
            <div class="publish-card-title">Options spéciales</div>
            <div class="publish-card-sub">Paramètres supplémentaires pour votre annonce.</div>

            <div class="student-option" id="studentOption" onclick="toggleStudent()">
                <div class="student-option-left">
                    <span style="font-size:24px;">🎓</span>
                    <div>
                        <div class="student-option-text">Réserver aux étudiants</div>
                        <div class="student-option-desc">Seuls les étudiants vérifiés pourront voir et contacter pour cette annonce</div>
                    </div>
                </div>
                <div class="toggle-switch" id="studentSwitch"></div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="publish-actions">
            <button type="button" class="publish-save">Sauvegarder brouillon</button>
            <button type="submit" class="publish-submit">Publier l'annonce →</button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
    function toggleAmenity(el) {
        el.classList.toggle('selected');
    }

    let studentOnly = false;
    function toggleStudent() {
        studentOnly = !studentOnly;
        document.getElementById('studentOption').classList.toggle('active', studentOnly);
    }
</script>
@endsection