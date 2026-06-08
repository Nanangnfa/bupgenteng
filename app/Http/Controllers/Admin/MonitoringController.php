<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bibit;
use App\Models\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $monitorings = Monitoring::with('bibit')->latest()->get();

        return view('admin.monitoring.index', compact('monitorings'));
    }

    public function create()
    {
        $bibits = Bibit::latest()->get();

        return view('admin.monitoring.create', compact('bibits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'tanggal_monitoring' => 'required|date',
            'jumlah_mati' => 'required|numeric|min:0',
            'catatan' => 'nullable',
        ]);

        $bibit = Bibit::findOrFail($request->bibit_id);

        if ($request->jumlah_mati > $bibit->stok_sekarang) {
            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_mati' => 'Jumlah mati tidak boleh melebihi stok tersedia.'
                ]);
        }

        $stokAkhir = $bibit->stok_sekarang - $request->jumlah_mati;

        Monitoring::create([
            'bibit_id' => $request->bibit_id,
            'tanggal_monitoring' => $request->tanggal_monitoring,
            'jumlah_mati' => $request->jumlah_mati,
            'stok_akhir' => $stokAkhir,
            'catatan' => $request->catatan,
        ]);

        $bibit->update([
            'stok_sekarang' => $stokAkhir,
        ]);

        return redirect()
            ->route('admin.monitoring.index')
            ->with('success', 'Data monitoring berhasil ditambahkan.');
    }

    public function edit(Monitoring $monitoring)
    {
        $bibits = Bibit::latest()->get();

        return view('admin.monitoring.edit', compact('monitoring', 'bibits'));
    }

    public function update(Request $request, Monitoring $monitoring)
    {
        $data = $request->validate([
            'bibit_id' => 'required|exists:bibits,id',
            'tanggal_monitoring' => 'required|date',
            'jumlah_mati' => 'required|integer|min:0',
            'stok_akhir' => 'required|integer|min:0',
            'catatan' => 'nullable',
        ]);

        $monitoring->update($data);

        $monitoring->bibit->update([
            'stok_sekarang' => $data['stok_akhir'],
            'status' => $data['stok_akhir'] > 0 ? 'tersedia' : 'habis',
        ]);

        return redirect()->route('admin.monitoring.index');
    }

    public function destroy(Monitoring $monitoring)
    {
        $monitoring->delete();

        return redirect()->route('admin.monitoring.index');
    }
}
