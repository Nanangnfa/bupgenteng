<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bibit;
use Illuminate\Http\Request;

class BibitController extends Controller
{
    public function index()
    {
        $bibits = Bibit::latest()->get();

        return view ('admin.bibit.index', compact('bibits'));
    }

    public function create()
    {
        return view('admin.bibit.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_bibit' => 'required',
            'nama_ikan' => 'required',
            'tanggal_tebar' => 'nullable|date',
            'jumlah_awal' => 'nullable|integer',
            'stok_sekarang' => 'nullable|integer',
            'deskripsi' => 'nullable',
            'status' => 'required|in:tersedia,habis',
        ]);

        Bibit::create($data);

        return redirect()->route('admin.bibit.index');
    }

    public function edit(Bibit $bibit)
    {
        return view('admin.bibit.edit', compact('bibit'));
    }

    public function update(Request $request, Bibit $bibit)
    {
        $data = $request->validate([
            'kode_bibit' => 'required',
            'nama_ikan' => 'required',
            'tanggal_tebar' => 'nullable|date',
            'jumlah_awal' => 'nullable|integer',
            'stok_sekarang' => 'nullable|integer',
            'deskripsi' => 'nullable',
            'status' => 'required|in:tersedia,habis',
        ]);

        $bibit->update($data);

        return redirect()->route('admin.bibit.index');
    }

    public function destroy(Bibit $bibit)
    {
        $bibit->delete();

        return redirect()->route('admin.bibit.index');
    }
}
