<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /** Liste de tous les utilisateurs */
    public function users(Request $request)
    {
        $users = User::when($request->role, fn($q, $v) => $q->where('role', $v))
                     ->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    /** Promouvoir/rétrograder un rôle */
    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,agent,client']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Rôle mis à jour.');
    }

    /** Liste de tous les biens (admin) */
    public function properties(Request $request)
    {
        $properties = Property::with('user')->latest()->paginate(20);
        return view('admin.properties', compact('properties'));
    }

    /** Messages de contact */
    public function contacts(Request $request)
    {
        $contacts = Contact::latest()->paginate(20);
        Contact::where('is_read', false)->update(['is_read' => true]);
        return view('admin.contacts', compact('contacts'));
    }

    /** Supprimer un utilisateur */
    public function destroyUser(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Impossible de vous supprimer vous-même.');
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }
}
