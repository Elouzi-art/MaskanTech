<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ✅ Laravel 11 : plus de $this->middleware() dans le constructeur
    // Le middleware role:admin est géré directement dans routes/web.php

    public function users(Request $request)
    {
        $users = User::when($request->role, fn($q, $v) => $q->where('role', $v))
                     ->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        // ✅ Inclure tous les rôles du projet
        $request->validate(['role' => 'required|in:admin,agent,client,student,owner']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Rôle mis à jour.');
    }

    public function properties(Request $request)
    {
        $properties = Property::with('user')->latest()->paginate(20);
        return view('admin.properties', compact('properties'));
    }

    public function contacts(Request $request)
    {
        $contacts = Contact::latest()->paginate(20);
        Contact::where('is_read', false)->update(['is_read' => true]);
        return view('admin.contacts', compact('contacts'));
    }

    public function destroyUser(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Impossible de vous supprimer vous-même.');
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }
}
