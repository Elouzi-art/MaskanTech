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

Route::get('/', function () {
    $recentProperties = \App\Models\Property::where('status', 'available')
        ->latest()
        ->take(3)
        ->get();
    return view('welcome', compact('recentProperties'));
})->name('home');

Route::get('/biens', [PropertyController::class, 'index'])->name('properties.index');

Route::get('/contact',  [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/etudiants',     fn() => view('pages.students'))->name('students');
Route::get('/proprietaires', fn() => view('pages.owners'))->name('owners');
Route::get('/a-propos',      fn() => view('pages.about'))->name('about');
Route::get('/blog',          fn() => view('pages.blog'))->name('blog');
Route::get('/blog/{slug}',   fn() => view('pages.blog-detail'))->name('blog.show');

Route::post('/biens/{property}/views', [PropertyController::class, 'incrementViews'])
    ->name('properties.views');

// ── AUTHENTIFIÉES ──────────────────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── Profil ──────────────────────────────────────────────────────────
    Route::get('/profil',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password',  [ProfileController::class, 'updatePassword'])->name('password.update');

    // ─── Biens CRUD ───────────────────────────────────────────────────────
    Route::get('/biens/creer',               [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/biens',                    [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/biens/{property}/modifier', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/biens/{property}',          [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/biens/{property}',       [PropertyController::class, 'destroy'])->name('properties.destroy');

    // ─── Favoris ─────────────────────────────────────────────────────────
    Route::get('/favoris',             [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoris/{property}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // ─── Rendez-vous ─────────────────────────────────────────────────────
    Route::get('/rendez-vous',                         [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/rendez-vous',                        [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/rendez-vous/{appointment}/statut',  [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::delete('/rendez-vous/{appointment}',        [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    // ─── Messagerie ──────────────────────────────────────────────────────
    Route::get('/messages',        [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages',       [MessageController::class, 'store'])->name('messages.store');

    // ─── Admin ────────────────────────────────────────────────────────────
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/',                                    [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/utilisateurs',                        [AdminController::class, 'users'])->name('users');
        Route::get('/utilisateurs/{user}',                 [AdminController::class, 'showUser'])->name('users.show');
        Route::patch('/utilisateurs/{user}/role',          [AdminController::class, 'updateRole'])->name('users.role');
        Route::patch('/utilisateurs/{user}/verifier',      [AdminController::class, 'verifyOwner'])->name('users.verify');
        Route::patch('/utilisateurs/{user}/deverifier',    [AdminController::class, 'unverifyOwner'])->name('users.unverify');
        Route::delete('/utilisateurs/{user}',              [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/biens',                               [AdminController::class, 'properties'])->name('properties');
        Route::patch('/biens/{property}/approuver',        [AdminController::class, 'approveProperty'])->name('properties.approve');
        Route::patch('/biens/{property}/rejeter',          [AdminController::class, 'rejectProperty'])->name('properties.reject');
        Route::delete('/biens/{property}',                 [AdminController::class, 'destroyProperty'])->name('properties.destroy');
        Route::get('/contacts',                            [AdminController::class, 'contacts'])->name('contacts');
    });
});

// ── BIENS SHOW — publique, déclarée EN DERNIER pour ne pas capturer /biens/creer ──
Route::get('/biens/{property}', [PropertyController::class, 'show'])->name('properties.show');

// ── AUTH (Breeze) ──────────────────────────────────────────────────────────
require __DIR__.'/auth.php';