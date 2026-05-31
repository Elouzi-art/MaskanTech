@extends('layouts.maskan')

@section('title', 'MaskanTech — Inscription')

@section('styles')
        body { overflow: hidden; }
        .register-wrap { display: flex; height: calc(100vh - 73px); }

        .left { width: 50%; position: relative; overflow: hidden; }
        .left-img {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 0.8s ease;
        }
        .left-img.active { opacity: 1; }
        .img-client { background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=900&q=85'); }
        .img-student { background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=900&q=85'); }
        .img-owner { background-image: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=900&q=85'); }
        .left-overlay {
            position: absolute; inset: 0; z-index: 2;
            background: linear-gradient(to top, rgba(10,7,3,0.85) 0%, rgba(10,7,3,0.2) 60%, transparent 100%);
        }
        .left-content {
            position: absolute; bottom: 0; left: 0; right: 0;
            z-index: 3; padding: 48px;
        }
        .left-tag {
            display: inline-block;
            background: rgba(200,135,58,0.25); border: 1px solid rgba(200,135,58,0.5);
            color: #E8A855; font-size: 11px; letter-spacing: 2px;
            text-transform: uppercase; padding: 6px 14px; border-radius: 20px;
            margin-bottom: 16px;
        }
        .left-title {
            font-family: 'Playfair Display', serif;
            font-size: 36px; font-weight: 700; color: #fff;
            line-height: 1.2; margin-bottom: 12px;
        }
        .left-title em { color: #E8A855; font-style: normal; }
        .left-sub { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 380px; }

        .right { width: 50%; overflow-y: auto; padding: 40px 56px; }

        .form-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .form-sub { font-size: 14px; color: #888; margin-bottom: 28px; }

        .role-label { font-size: 12px; color: #888; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 500; margin-bottom: 12px; }
        .roles { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 24px; }
        .role-btn {
            border: 1.5px solid #e8e3db; border-radius: 10px;
            padding: 14px 10px; text-align: center; cursor: pointer;
            transition: all 0.25s; background: #fff;
        }
        .role-btn:hover { border-color: #C8873A; background: #fdf6ee; }
        .role-btn.active { border-color: #C8873A; background: #fdf6ee; }
        .role-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: #f0ede8; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px; font-size: 18px; transition: background 0.25s;
        }
        .role-btn.active .role-icon { background: #C8873A; }
        .role-name { font-size: 13px; font-weight: 500; color: #1a1a1a; }
        .role-desc { font-size: 11px; color: #999; margin-top: 3px; }

        .cin-section, .student-section { display: none; margin-bottom: 18px; border-radius: 10px; padding: 18px; }
        .cin-section.visible, .student-section.visible { display: block; }
        .cin-section { background: #fdf6ee; border: 1.5px solid #f0d9b5; }
        .student-section { background: #f0f7ff; border: 1.5px solid #b8d4f0; }
        .extra-title { font-size: 13px; font-weight: 500; margin-bottom: 6px; }
        .cin-section .extra-title { color: #C8873A; }
        .student-section .extra-title { color: #185FA5; }
        .extra-desc { font-size: 12px; color: #888; margin-bottom: 14px; line-height: 1.6; }
        .cin-upload {
            border: 2px dashed #e0c99a; border-radius: 8px;
            padding: 20px; text-align: center; cursor: pointer;
            background: #fff; transition: border-color 0.2s;
        }
        .cin-upload:hover { border-color: #C8873A; }
        .cin-upload-icon { font-size: 26px; margin-bottom: 8px; }
        .cin-upload-text { font-size: 13px; color: #888; }
        .cin-upload-text span { color: #C8873A; font-weight: 500; }
        .student-section input {
            width: 100%; padding: 11px 14px; margin-bottom: 10px;
            border: 1.5px solid #b8d4f0; border-radius: 8px;
            font-size: 14px; font-family: 'DM Sans', sans-serif;
            outline: none; background: #fff;
        }
        .student-section input:last-child { margin-bottom: 0; }

        .alert-error {
            background: #fff0f0; border: 1px solid #ffcccc; color: #cc0000;
            padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;
            font-size: 13px; line-height: 1.6;
        }

        .submit-btn {
            width: 100%; padding: 15px;
            background: #1a1a1a; color: #fff; border: none;
            border-radius: 8px; font-size: 15px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; margin-top: 8px;
        }
        .submit-btn:hover { background: #C8873A; }
        .login-link { text-align: center; margin-top: 18px; font-size: 13px; color: #888; }
        .login-link a { color: #C8873A; text-decoration: none; font-weight: 500; }
@endsection

@section('head')
    <style>
        footer { display: none !important; }
        .mk-nav { display: none; }
        .register-wrap { height: 100vh; }
    </style>
@endsection

@section('content')
<div class="register-wrap">

    {{-- LEFT --}}
    <div class="left">
        <div class="left-img img-client active" id="img-client"></div>
        <div class="left-img img-student" id="img-student"></div>
        <div class="left-img img-owner" id="img-owner"></div>
        <div class="left-overlay"></div>
        <div class="left-content">
            <div class="left-tag" id="left-tag">🏠 Locataire</div>
            <h2 class="left-title" id="left-title">Trouvez votre<br><em>chez-vous</em><br>au Maroc</h2>
            <p class="left-sub" id="left-sub">Des milliers d'annonces vérifiées partout au Maroc, sans commission.</p>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="right">
        <a href="{{ route('home') }}" class="mk-logo" style="margin-bottom:32px;display:flex;">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        <h1 class="form-title">Créer un compte</h1>
        <p class="form-sub">Rejoignez MaskanTech et trouvez votre logement idéal.</p>

        <div class="role-label">Je suis</div>
        <div class="roles">
            <div class="role-btn active" onclick="selectRole('client', this)">
                <div class="role-icon">🏠</div>
                <div class="role-name">Locataire</div>
                <div class="role-desc">Je cherche un logement</div>
            </div>
            <div class="role-btn" onclick="selectRole('student', this)">
                <div class="role-icon">🎓</div>
                <div class="role-name">Étudiant</div>
                <div class="role-desc">Je cherche un logement étudiant</div>
            </div>
            <div class="role-btn" onclick="selectRole('owner', this)">
                <div class="role-icon">🏢</div>
                <div class="role-name">Propriétaire</div>
                <div class="role-desc">Je loue mon bien</div>
            </div>
        </div>

        {{-- Erreurs --}}
        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Formulaire connecté au backend --}}
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <input type="hidden" name="role" id="role-input" value="client">

            <div class="mk-form-group">
                <label>Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Prénom et nom" required>
            </div>

            <div class="mk-form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
            </div>

            <div class="mk-form-group">
                <label>Téléphone</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+212 6XX XXX XXX">
            </div>

            {{-- ÉTUDIANT --}}
            <div class="student-section" id="student-section">
                <div class="extra-title">🎓 Informations étudiant</div>
                <div class="extra-desc">Ces informations nous permettent de vous afficher les annonces réservées aux étudiants.</div>
                <input type="text" name="university" value="{{ old('university') }}" placeholder="Nom de votre université / école">
                <input type="text" name="field_of_study" value="{{ old('field_of_study') }}" placeholder="Filière / spécialité">
            </div>

            {{-- PROPRIÉTAIRE --}}
            <div class="cin-section" id="cin-section">
                <div class="extra-title">🪪 Vérification d'identité</div>
                <div class="extra-desc">Pour garantir la sécurité de notre plateforme, nous avons besoin d'une copie de votre CIN.</div>
                <label class="cin-upload" onclick="document.getElementById('cin-file').click()">
                    <div class="cin-upload-icon">📄</div>
                    <div class="cin-upload-text">Glissez votre CIN ici ou <span>cliquez pour choisir</span></div>
                    <input type="file" name="cin_document" id="cin-file" accept="image/*,.pdf" onchange="showFileName(this)" style="display:none;">
                </label>
                <p id="cin-filename" style="font-size:12px;color:#C8873A;margin-top:8px;text-align:center;"></p>
            </div>

            <div class="mk-form-row">
                <div class="mk-form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="mk-form-group">
                    <label>Confirmer</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submit-btn">Créer mon compte</button>
        </form>

        <div class="login-link">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const roles = {
        client: {
            tag: '🏠 Locataire',
            title: 'Trouvez votre<br><em>chez-vous</em><br>au Maroc',
            sub: 'Des milliers d\'annonces vérifiées partout au Maroc, sans commission.',
            img: 'client'
        },
        student: {
            tag: '🎓 Étudiant',
            title: 'Des logements<br><em>faits pour vous</em><br>près de votre campus',
            sub: 'Filtrez uniquement les annonces ouvertes aux étudiants et trouvez votre chambre idéale.',
            img: 'student'
        },
        owner: {
            tag: '🏢 Propriétaire',
            title: 'Publiez votre bien<br>et trouvez votre<br><em>locataire idéal</em>',
            sub: 'Créez votre annonce gratuitement et gérez vos locations depuis votre tableau de bord.',
            img: 'owner'
        }
    };

    function selectRole(role, el) {
        document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('role-input').value = role;

        const r = roles[role];
        document.getElementById('left-tag').textContent = r.tag;
        document.getElementById('left-title').innerHTML = r.title;
        document.getElementById('left-sub').textContent = r.sub;
        document.querySelectorAll('.left-img').forEach(i => i.classList.remove('active'));
        document.getElementById('img-' + r.img).classList.add('active');

        document.getElementById('cin-section').classList.toggle('visible', role === 'owner');
        document.getElementById('student-section').classList.toggle('visible', role === 'student');

        const btn = document.getElementById('submit-btn');
        btn.textContent = role === 'owner'   ? 'Soumettre mon dossier'      :
                          role === 'student' ? 'Créer mon compte étudiant'  :
                                               'Créer mon compte';
    }

    function showFileName(input) {
        if (input.files && input.files[0]) {
            document.getElementById('cin-filename').textContent = '✅ ' + input.files[0].name;
        }
    }
</script>
@endsection