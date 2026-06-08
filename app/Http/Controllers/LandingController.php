<?php

namespace App\Http\Controllers;

use App\Models\Bibit;
use App\Models\Pemesanan;
use App\Models\ProfilBalai;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $profil = ProfilBalai::first();
        $bibits = Bibit::where('status', 'tersedia')->latest()->get();

        return view('landing.index', compact('profil', 'bibits'));
    }

    public function profil()
    {
        $profil = ProfilBalai::first();

        return view('landing.profil', compact('profil'));
    }

    public function visiMisi()
    {
        $profil = ProfilBalai::first();

        return view('landing.visi-misi', compact('profil'));
    }

    public function formPemesanan()
    {
        $bibits = Bibit::where('status', 'tersedia')->latest()->get();
        $profil = ProfilBalai::first(); // ambil profil pertama

        return view('landing.pemesanan', compact('bibits', 'profil'));
    }

    public function storePemesanan(Request $request)
    {
        $data = $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'nama_customer' => 'required',
            'no_whatsapp' => 'required',
            'alamat' => 'nullable',
            'jumlah_pesan' => 'required|integer|min:1',
            'catatan' => 'nullable',
        ]);

        $data['kode_pemesanan'] = 'PMS-' . now()->format('YmdHis');
        $data['status'] = 'pending';

        Pemesanan::create($data);

        return redirect()
            ->route('landing.pemesanan')
            ->with('success', 'Pemesanan berhasil dikirim. Admin akan menghubungi melalui WhatsApp.');
    }
}
