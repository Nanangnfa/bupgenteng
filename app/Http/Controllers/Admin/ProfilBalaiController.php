<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilBalai;
use Illuminate\Http\Request;

class ProfilBalaiController extends Controller
{
    public function index()
    {
        $profil = ProfilBalai::first();

        if (!$profil) {
            $profil = ProfilBalai::create([
                'nama_balai' => 'Balai Usaha Perikanan Genteng',
            ]);
        }

        return view('admin.profil-balai.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_balai' => 'nullable',
            'sejarah' => 'nullable',
            'visi' => 'nullable',
            'misi' => 'nullable',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'email' => 'nullable|email',
            'maps' => 'nullable',
        ]);

        $profil = ProfilBalai::first();

        if (!$profil) {
            $profil = ProfilBalai::create($data);
        } else {
            $profil->update($data);
        }

        return redirect()
            ->route('admin.profil-balai.index')
            ->with('success', 'Profil balai berhasil diperbarui.');
    }
}
