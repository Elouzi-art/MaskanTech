@extends('layouts.maskan')

@section('title', 'MaskanTech — Rendez-vous')

@section('styles')
.rdv-wrap { max-width: 1100px; margin: 0 auto; padding: 48px; }

/* HEADER */
.rdv-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 36px;
}
.rdv-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px; font-weight: 700; color: #1a1a1a;
}
.rdv-subtitle { font-size: 14px; color: #888; margin-top: 4px; }

/* TABS */
.rdv-tabs {
    display: flex; gap: 4px; margin-bottom: 28px;
    background: #f0ede8; border-radius: 10px; padding: 4px;
    width: fit-content;
}
.rdv-tab {
    padding: 10px 24px; border-radius: 8px;
    font-size: 14px; font-weight: 500; cursor: pointer;
    transition: all 0.2s; color: #888; border: none;
    background: transparent; font-family: 'DM Sans', sans-serif;
}
.rdv-tab.active { background: #fff; color: #1a1a1a; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }

/* GRID */
.rdv-grid { display: grid; grid-template-columns: 1fr 360px; gap: 32px; }

/* CALENDAR */
.calendar-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 16px; padding: 28px;
}
.calendar-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px;
}
.calendar-month {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700; color: #1a1a1a;
}
.calendar-nav {
    display: flex; gap: 8px;
}
.calendar-nav-btn {
    width: 32px; height: 32px; border-radius: 8px;
    border: 1.5px solid #e8e3db; background: #fff;
    cursor: pointer; font-size: 14px; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center;
}
.calendar-nav-btn:hover { border-color: #C8873A; color: #C8873A; }
.calendar-days-header {
    display: grid; grid-template-columns: repeat(7,1fr);
    text-align: center; margin-bottom: 8px;
}
.calendar-day-name {
    font-size: 12px; color: #888; font-weight: 500;
    padding: 8px 0;
}
.calendar-grid {
    display: grid; grid-template-columns: repeat(7,1fr);
    gap: 4px;
}
.calendar-day {
    aspect-ratio: 1; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; cursor: pointer; transition: all 0.2s;
    position: relative;
}
.calendar-day:hover { background: #fdf6ee; color: #C8873A; }
.calendar-day.today {
    background: #1a1a1a; color: #fff; font-weight: 600;
}
.calendar-day.has-rdv::after {
    content: ''; position: absolute; bottom: 4px;
    width: 4px; height: 4px; border-radius: 50%;
    background: #C8873A;
}
.calendar-day.selected { background: #C8873A; color: #fff; }
.calendar-day.other-month { color: #ccc; }

/* RDV LIST */
.rdv-list { display: flex; flex-direction: column; gap: 16px; }
.rdv-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 20px; display: flex;
    align-items: center; gap: 16px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.rdv-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
.rdv-date-box {
    text-align: center; padding: 12px 16px;
    background: #fdf6ee; border-radius: 10px; flex-shrink: 0;
    min-width: 64px;
}
.rdv-date-day {
    font-family: 'Playfair Display', serif;
    font-size: 28px; font-weight: 700; color: #C8873A; line-height: 1;
}
.rdv-date-month { font-size: 12px; color: #888; margin-top: 4px; }
.rdv-info { flex: 1; }
.rdv-property { font-size: 15px; font-weight: 500; color: #1a1a1a; margin-bottom: 4px; }
.rdv-owner { font-size: 13px; color: #888; margin-bottom: 6px; }
.rdv-time { font-size: 13px; color: #555; }
.rdv-badges { display: flex; gap: 8px; margin-top: 8px; }
.rdv-actions { display: flex; flex-direction: column; gap: 8px; }
.rdv-btn {
    padding: 8px 16px; border-radius: 7px;
    font-size: 12px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: all 0.2s;
    border: 1.5px solid #e8e3db; background: transparent; color: #555;
    white-space: nowrap;
}
.rdv-btn:hover { border-color: #C8873A; color: #C8873A; }
.rdv-btn-cancel { color: #ff6b6b; }
.rdv-btn-cancel:hover { border-color: #ff6b6b; color: #ff6b6b; background: #fff0f0; }

/* RIGHT PANEL */
.rdv-right { display: flex; flex-direction: column; gap: 20px; }
.rdv-summary-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 16px; padding: 24px;
}
.rdv-summary-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 16px;
}
.rdv-summary-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.rdv-stat {
    text-align: center; padding: 16px;
    background: #fafaf8; border-radius: 10px;
}
.rdv-stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 24px; font-weight: 700; color: #C8873A;
}
.rdv-stat-label { font-size: 12px; color: #888; margin-top: 4px; }

/* NOUVEAU RDV FORM */
.new-rdv-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 16px; padding: 24px;
}
.new-rdv-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 16px;
}
.new-rdv-submit {
    width: 100%; padding: 13px; background: #1a1a1a;
    color: #fff; border: none; border-radius: 8px;
    font-size: 14px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: background 0.2s;
    margin-top: 8px;
}
.new-rdv-submit:hover { background: #C8873A; }
@endsection

@section('content')
<div class="rdv-wrap">

    {{-- HEADER --}}
    <div class="rdv-header">
        <div>
            <div class="rdv-title">Mes rendez-vous</div>
            <div class="rdv-subtitle">Gérez vos visites et rendez-vous immobiliers</div>
        </div>
    </div>

    {{-- TABS --}}
    <div class="rdv-tabs">
        <button class="rdv-tab active" onclick="switchTab(this, 'upcoming')">À venir (2)</button>
        <button class="rdv-tab" onclick="switchTab(this, 'past')">Passés (3)</button>
        <button class="rdv-tab" onclick="switchTab(this, 'all')">Tous (5)</button>
    </div>

    <div class="rdv-grid">

        {{-- LEFT --}}
        <div>
            {{-- CALENDAR --}}
            <div class="calendar-card" style="margin-bottom:24px;">
                <div class="calendar-header">
                    <div class="calendar-month">Mai 2026</div>
                    <div class="calendar-nav">
                        <button class="calendar-nav-btn">‹</button>
                        <button class="calendar-nav-btn">›</button>
                    </div>
                </div>
                <div class="calendar-days-header">
                    <div class="calendar-day-name">Lun</div>
                    <div class="calendar-day-name">Mar</div>
                    <div class="calendar-day-name">Mer</div>
                    <div class="calendar-day-name">Jeu</div>
                    <div class="calendar-day-name">Ven</div>
                    <div class="calendar-day-name">Sam</div>
                    <div class="calendar-day-name">Dim</div>
                </div>
                <div class="calendar-grid" id="calendarGrid"></div>
            </div>

            {{-- RDV LIST --}}
            <div class="rdv-list" id="rdvList">

                <div class="rdv-card" data-status="upcoming">
                    <div class="rdv-date-box">
                        <div class="rdv-date-day">15</div>
                        <div class="rdv-date-month">Mai</div>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-property">🏠 Studio meublé — Guéliz</div>
                        <div class="rdv-owner">👤 Mohammed Karimi · Propriétaire</div>
                        <div class="rdv-time">🕙 10:00 — 35m² · Marrakech</div>
                        <div class="rdv-badges">
                            <span class="mk-badge mk-badge-blue">Confirmé</span>
                            <span class="mk-badge mk-badge-gold">Visite</span>
                        </div>
                    </div>
                    <div class="rdv-actions">
                        <button class="rdv-btn">💬 Message</button>
                        <button class="rdv-btn rdv-btn-cancel">✕ Annuler</button>
                    </div>
                </div>

                <div class="rdv-card" data-status="upcoming">
                    <div class="rdv-date-box">
                        <div class="rdv-date-day">16</div>
                        <div class="rdv-date-month">Mai</div>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-property">🏠 Appartement F2 — Casablanca</div>
                        <div class="rdv-owner">👤 Sara Benali · Propriétaire</div>
                        <div class="rdv-time">🕑 14:00 — 65m² · Casablanca</div>
                        <div class="rdv-badges">
                            <span class="mk-badge" style="background:#fff3e0;color:#e65100;">En attente</span>
                            <span class="mk-badge mk-badge-gold">Visite</span>
                        </div>
                    </div>
                    <div class="rdv-actions">
                        <button class="rdv-btn">💬 Message</button>
                        <button class="rdv-btn rdv-btn-cancel">✕ Annuler</button>
                    </div>
                </div>

                <div class="rdv-card" data-status="past" style="opacity:0.6;">
                    <div class="rdv-date-box" style="background:#f0ede8;">
                        <div class="rdv-date-day" style="color:#888;">05</div>
                        <div class="rdv-date-month">Mai</div>
                    </div>
                    <div class="rdv-info">
                        <div class="rdv-property">🏠 Villa avec piscine — Agadir</div>
                        <div class="rdv-owner">👤 Ahmed Karimi · Propriétaire</div>
                        <div class="rdv-time">🕙 11:00 — 180m² · Agadir</div>
                        <div class="rdv-badges">
                            <span class="mk-badge mk-badge-green">Effectué</span>
                        </div>
                    </div>
                    <div class="rdv-actions">
                        <button class="rdv-btn">⭐ Avis</button>
                    </div>
                </div>

            </div>
        </div>

        {{-- RIGHT --}}
        <div class="rdv-right">

            {{-- SUMMARY --}}
            <div class="rdv-summary-card">
                <div class="rdv-summary-title">Résumé</div>
                <div class="rdv-summary-stats">
                    <div class="rdv-stat">
                        <div class="rdv-stat-value">2</div>
                        <div class="rdv-stat-label">À venir</div>
                    </div>
                    <div class="rdv-stat">
                        <div class="rdv-stat-value">3</div>
                        <div class="rdv-stat-label">Effectués</div>
                    </div>
                    <div class="rdv-stat">
                        <div class="rdv-stat-value">0</div>
                        <div class="rdv-stat-label">Annulés</div>
                    </div>
                    <div class="rdv-stat">
                        <div class="rdv-stat-value">5</div>
                        <div class="rdv-stat-label">Total</div>
                    </div>
                </div>
            </div>

            {{-- NOUVEAU RDV --}}
            <div class="new-rdv-card">
                <div class="new-rdv-title">📅 Demander un rendez-vous</div>
                <div class="mk-form-group">
                    <label>Annonce</label>
                    <select>
                        <option>Studio meublé — Guéliz</option>
                        <option>Appartement F2 — Casablanca</option>
                        <option>Villa — Agadir</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Date souhaitée</label>
                    <input type="date">
                </div>
                <div class="mk-form-group">
                    <label>Heure souhaitée</label>
                    <select>
                        <option>09:00</option>
                        <option>10:00</option>
                        <option>11:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option>17:00</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Message (optionnel)</label>
                    <textarea rows="3" placeholder="Précisez votre demande..."></textarea>
                </div>
                <button class="new-rdv-submit">Envoyer la demande</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // CALENDAR
    const rdvDays = [15, 16];
    const today = 13;
    const daysInMonth = 31;
    const firstDay = 4; // Mai 2026 commence un vendredi (index 4 lundi=0)

    function buildCalendar() {
        const grid = document.getElementById('calendarGrid');
        grid.innerHTML = '';

        for (let i = 0; i < firstDay; i++) {
            const empty = document.createElement('div');
            empty.className = 'calendar-day other-month';
            const prevDay = 30 - firstDay + i + 1;
            empty.textContent = prevDay;
            grid.appendChild(empty);
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const day = document.createElement('div');
            day.className = 'calendar-day';
            day.textContent = d;
            if (d === today) day.classList.add('today');
            if (rdvDays.includes(d)) day.classList.add('has-rdv');
            day.onclick = () => {
                document.querySelectorAll('.calendar-day').forEach(x => x.classList.remove('selected'));
                day.classList.add('selected');
            };
            grid.appendChild(day);
        }
    }

    buildCalendar();

    // TABS
    function switchTab(btn, status) {
        document.querySelectorAll('.rdv-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.rdv-card').forEach(card => {
            if (status === 'all') {
                card.style.display = 'flex';
            } else {
                card.style.display = card.dataset.status === status ? 'flex' : 'none';
            }
        });
    }

    switchTab(document.querySelector('.rdv-tab.active'), 'upcoming');
</script>
@endsection