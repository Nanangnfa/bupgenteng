<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors([
                'delete' => 'Akun yang sedang login tidak boleh dihapus.'
            ]);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
