<?php
// routes/web.php — MaskanTech — Routes complètes
declare(strict_types=1);

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

// ── PUBLIQUES ──────────────────────────────────────────────────────────────

// Page d'accueil — landing page design MaskanTech
Route::get('/', fn() => view('welcome'))->name('home');

// Route /home utilisée par Breeze après login
Route::get('/home', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Liste des biens (publique)
Route::get('/biens', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/biens/creer', [PropertyController::class, 'create'])->name('properties.create');
Route::get('/biens/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Contact
Route::get('/contact',  [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Pages publiques statiques (layout maskan)
Route::get('/etudiants',    fn() => view('pages.students'))->name('students');
Route::get('/proprietaires', fn() => view('pages.owners'))->name('owners');
Route::get('/a-propos',     fn() => view('pages.about'))->name('about');
Route::get('/blog',         fn() => view('pages.blog'))->name('blog');
Route::get('/blog/{slug}',  fn() => view('pages.blog-detail'))->name('blog.show');

// Incrémenter les vues (AJAX, pas besoin d'auth)
Route::post('/biens/{property}/views', [PropertyController::class, 'incrementViews'])
    ->name('properties.views');

// ── AUTHENTIFIÉES ──────────────────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (redirige vers la vue selon le rôle)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── Profil ──────────────────────────────────────────────────────────
    Route::get('/profil',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ─── Biens (CRUD — owner / agent / admin) ────────────────────────────
    Route::post('/biens',                [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/biens/{property}/modifier', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/biens/{property}',      [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/biens/{property}',   [PropertyController::class, 'destroy'])->name('properties.destroy');

    // ─── Favoris ─────────────────────────────────────────────────────────
    Route::get('/favoris', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoris/{property}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // ─── Rendez-vous ─────────────────────────────────────────────────────
    Route::get('/rendez-vous', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/rendez-vous', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/rendez-vous/{appointment}/statut', [AppointmentController::class, 'updateStatus'])
        ->name('appointments.status');
    Route::delete('/rendez-vous/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

    // ─── Messagerie ──────────────────────────────────────────────────────
    Route::get('/messages',         [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}',  [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages',        [MessageController::class, 'store'])->name('messages.store');

    // ─── Admin (role:admin) ───────────────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/utilisateurs',             [AdminController::class, 'users'])->name('users');
        Route::patch('/utilisateurs/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
        Route::delete('/utilisateurs/{user}',   [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/biens',                    [AdminController::class, 'properties'])->name('properties');
        Route::get('/contacts',                 [AdminController::class, 'contacts'])->name('contacts');
    });
});

// ── AUTH (Breeze) ──────────────────────────────────────────────────────────
require __DIR__.'/auth.php';
