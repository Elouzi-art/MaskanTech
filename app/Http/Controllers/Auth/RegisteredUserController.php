<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDATION
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // rôles autorisés
            'role' => ['required', 'in:tenant,student,owner'],

            'phone' => ['nullable', 'string', 'max:20'],

            // étudiant
            'university' => ['nullable', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],

            // propriétaire (fichier CIN)
            'cin_document' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ]);

        // 2. UPLOAD CIN (seulement owner)
        $cinPath = null;

        if ($request->role === 'owner' && $request->hasFile('cin_document')) {
            $cinPath = $request->file('cin_document')
                ->store('cin_documents', 'public');
        }

        // 3. CRÉATION UTILISATEUR
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,

            'password' => Hash::make($request->password),

            // étudiant uniquement
            'university' => $request->role === 'student'
                ? $request->university
                : null,

            'field_of_study' => $request->role === 'student'
                ? $request->field_of_study
                : null,

            // propriétaire uniquement
            'cin_document' => $cinPath,
        ]);

        // 4. LOGIN AUTOMATIQUE
        event(new Registered($user));
        Auth::login($user);

        // 5. REDIRECTION
        return redirect()->route('dashboard');
    }
}