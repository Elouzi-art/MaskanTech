<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaskanTech — Inscription</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%23C8873A'/><path d='M6 14L16 7l10 7v10a1 1 0 01-1 1H7a1 1 0 01-1-1V14z' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/><path d='M13 22v-6h6v6' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #fff; height: 100vh; display: flex; overflow: hidden; }

        /* LEFT PANEL */
        .left {
            width: 50%; position: relative; overflow: hidden;
            transition: all 0.6s ease;
        }
        .left-img {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 0.8s ease;
        }
        .left-img.active { opacity: 1; }
        .img-locataire { background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=900&q=85'); }
        .img-etudiant { background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=900&q=85'); }
        .img-proprietaire { background-image: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=900&q=85'); }

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
            font-size: 38px; font-weight: 700; color: #fff;
            line-height: 1.2; margin-bottom: 12px;
        }
        .left-title em { color: #E8A855; font-style: normal; }
        .left-sub { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 380px; }

        /* RIGHT PANEL */
        .right {
            width: 50%; overflow-y: auto;
            padding: 48px 56px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 40px; }
        .logo-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #C8873A, #E8A855);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { width: 18px; height: 18px; }
        .logo-text { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #1a1a1a; }
        .logo-text span { color: #C8873A; }

        .form-title { font-family: 'Playfair Display', serif; font-size: 30px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .form-sub { font-size: 14px; color: #888; margin-bottom: 32px; }

        /* ROLE SELECTOR */
        .role-label { font-size: 12px; color: #888; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 500; margin-bottom: 12px; }
        .roles { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 28px; }
        .role-btn {
            border: 1.5px solid #e8e3db; border-radius: 10px;
            padding: 14px 10px; text-align: center; cursor: pointer;
            transition: all 0.25s; background: #fff;
        }
        .role-btn:hover { border-color: #C8873A; background: #fdf6ee; }
        .role-btn.active { border-color: #C8873A; background: #fdf6ee; }
        .role-btn.active .role-icon { background: #C8873A; }
        .role-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: #f0ede8; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px; font-size: 18px; transition: background 0.25s;
        }
        .role-name { font-size: 13px; font-weight: 500; color: #1a1a1a; }
        .role-desc { font-size: 11px; color: #999; margin-top: 3px; }

        /* FORM */
        .form-group { margin-bottom: 18px; }
        .form-group label { font-size: 12px; color: #666; letter-spacing: 1px; text-transform: uppercase; font-weight: 500; display: block; margin-bottom: 7px; }
        .form-group input {
            width: 100%; padding: 13px 16px;
            border: 1.5px solid #e8e3db; border-radius: 8px;
            font-size: 14px; font-family: 'DM Sans', sans-serif; color: #1a1a1a;
            outline: none; transition: border-color 0.2s; background: #fff;
        }
        .form-group input:focus { border-color: #C8873A; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* CIN SECTION */
        .cin-section {
            display: none; margin-bottom: 18px;
            background: #fdf6ee; border: 1.5px solid #f0d9b5;
            border-radius: 10px; padding: 18px;
        }
        .cin-section.visible { display: block; }
        .cin-title { font-size: 13px; font-weight: 500; color: #C8873A; margin-bottom: 6px; }
        .cin-desc { font-size: 12px; color: #888; margin-bottom: 14px; line-height: 1.6; }
        .cin-upload {
            border: 2px dashed #e0c99a; border-radius: 8px;
            padding: 24px; text-align: center; cursor: pointer;
            background: #fff; transition: border-color 0.2s;
        }
        .cin-upload:hover { border-color: #C8873A; }
        .cin-upload-icon { font-size: 28px; margin-bottom: 8px; }
        .cin-upload-text { font-size: 13px; color: #888; }
        .cin-upload-text span { color: #C8873A; font-weight: 500; }
        .cin-upload input { display: none; }

        /* STUDENT SECTION */
        .student-section {
            display: none; margin-bottom: 18px;
            background: #f0f7ff; border: 1.5px solid #b8d4f0;
            border-radius: 10px; padding: 18px;
        }
        .student-section.visible { display: block; }
        .student-title { font-size: 13px; font-weight: 500; color: #185FA5; margin-bottom: 6px; }
        .student-desc { font-size: 12px; color: #888; margin-bottom: 14px; line-height: 1.6; }
        .student-section input {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #b8d4f0; border-radius: 8px;
            font-size: 14px; font-family: 'DM Sans', sans-serif;
            outline: none; background: #fff;
        }

        /* SUBMIT */
        .submit-btn {
            width: 100%; padding: 15px;
            background: #1a1a1a; color: #fff;
            border: none; border-radius: 8px;
            font-size: 15px; font-weight: 500; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; margin-top: 8px;
        }
        .submit-btn:hover { background: #C8873A; }

        .login-link { text-align: center; margin-top: 20px; font-size: 13px; color: #888; }
        .login-link a { color: #C8873A; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>

    <!-- LEFT PANEL -->
    <div class="left">
        <div class="left-img img-locataire active" id="img-locataire"></div>
        <div class="left-img img-etudiant" id="img-etudiant"></div>
        <div class="left-img img-proprietaire" id="img-proprietaire"></div>
        <div class="left-overlay"></div>
        <div class="left-content">
            <div class="left-tag" id="left-tag">🏠 Locataire</div>
            <h2 class="left-title" id="left-title">Trouvez votre<br><em>chez-vous</em><br>au Maroc</h2>
            <p class="left-sub" id="left-sub">Des milliers d'annonces vérifiées partout au Maroc, sans commission.</p>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right">
        <a href="/" class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="logo-text">Maskan<span>Tech</span></span>
        </a>

        <h1 class="form-title">Créer un compte</h1>
        <p class="form-sub">Rejoignez MaskanTech et trouvez votre logement idéal.</p>

        <!-- ROLE SELECTOR -->
        <div class="role-label">Je suis</div>
        <div class="roles">
            <div class="role-btn active" onclick="selectRole('locataire')">
                <div class="role-icon">🏠</div>
                <div class="role-name">Locataire</div>
                <div class="role-desc">Je cherche un logement</div>
            </div>
            <div class="role-btn" onclick="selectRole('etudiant')">
                <div class="role-icon">🎓</div>
                <div class="role-name">Étudiant</div>
                <div class="role-desc">Je cherche un logement étudiant</div>
            </div>
            <div class="role-btn" onclick="selectRole('proprietaire')">
                <div class="role-icon">🏢</div>
                <div class="role-name">Propriétaire</div>
                <div class="role-desc">Je loue mon bien</div>
            </div>
        </div>

        <form>
            @csrf
            <input type="hidden" name="role" id="role-input" value="locataire">

            <div class="form-row">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" placeholder="Votre prénom" required>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" placeholder="Votre nom" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="exemple@email.com" required>
            </div>

            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" placeholder="+212 6XX XXX XXX">
            </div>

            <!-- SECTION ÉTUDIANT -->
            <div class="student-section" id="student-section">
                <div class="student-title">🎓 Informations étudiant</div>
                <div class="student-desc">Ces informations nous permettent de vous afficher les annonces réservées aux étudiants.</div>
                <input type="text" placeholder="Nom de votre université / école" style="margin-bottom:10px;">
                <input type="text" placeholder="Filière / spécialité">
            </div>

            <!-- SECTION PROPRIÉTAIRE -->
            <div class="cin-section" id="cin-section">
                <div class="cin-title">🪪 Vérification d'identité</div>
                <div class="cin-desc">Pour garantir la sécurité de notre plateforme, nous avons besoin d'une copie de votre CIN. Votre profil sera activé après validation par notre équipe.</div>
                <label class="cin-upload" onclick="document.getElementById('cin-file').click()">
                    <div class="cin-upload-icon">📄</div>
                    <div class="cin-upload-text">Glissez votre CIN ici ou <span>cliquez pour choisir</span></div>
                    <input type="file" id="cin-file" accept="image/*,.pdf" onchange="showFileName(this)">
                </label>
                <p id="cin-filename" style="font-size:12px;color:#C8873A;margin-top:8px;text-align:center;"></p>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label>Confirmer</label>
                    <input type="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submit-btn">Créer mon compte</button>
        </form>

        <div class="login-link">
            Déjà un compte ? <a href="/login">Se connecter</a>
        </div>
    </div>

    <script>
        const roles = {
            locataire: {
                tag: '🏠 Locataire',
                title: 'Trouvez votre<br><em>chez-vous</em><br>au Maroc',
                sub: 'Des milliers d\'annonces vérifiées partout au Maroc, sans commission.',
                img: 'locataire'
            },
            etudiant: {
                tag: '🎓 Étudiant',
                title: 'Des logements<br><em>faits pour vous</em><br>près de votre campus',
                sub: 'Filtrez uniquement les annonces ouvertes aux étudiants et trouvez votre chambre idéale.',
                img: 'etudiant'
            },
            proprietaire: {
                tag: '🏢 Propriétaire',
                title: 'Publiez votre bien<br>et trouvez votre<br><em>locataire idéal</em>',
                sub: 'Créez votre annonce gratuitement et gérez vos locations depuis votre tableau de bord.',
                img: 'proprietaire'
            }
        };

        function selectRole(role) {
            document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
            event.currentTarget.classList.add('active');
            document.getElementById('role-input').value = role;

            const r = roles[role];
            document.getElementById('left-tag').textContent = r.tag;
            document.getElementById('left-title').innerHTML = r.title;
            document.getElementById('left-sub').textContent = r.sub;

            document.querySelectorAll('.left-img').forEach(i => i.classList.remove('active'));
            document.getElementById('img-' + r.img).classList.add('active');

            document.getElementById('cin-section').classList.toggle('visible', role === 'proprietaire');
            document.getElementById('student-section').classList.toggle('visible', role === 'etudiant');

            const btn = document.getElementById('submit-btn');
            btn.textContent = role === 'proprietaire' ? 'Soumettre mon dossier' :
                              role === 'etudiant' ? 'Créer mon compte étudiant' :
                              'Créer mon compte';
        }

        function showFileName(input) {
            if (input.files && input.files[0]) {
                document.getElementById('cin-filename').textContent = '✅ ' + input.files[0].name;
            }
        }
    </script>

</body>
</html>