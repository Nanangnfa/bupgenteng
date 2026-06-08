<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bibit;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('bibit')->latest()->get();

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function edit(Pemesanan $pemesanan)
    {
        return view('admin.pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak,selesai',
        ]);

        try {
            DB::transaction(function () use ($pemesanan, $data) {

                $statusLama = $pemesanan->status;
                $statusBaru = $data['status'];

                $statusMengurangiStok = ['disetujui', 'selesai'];

                $sebelumnyaMengurangi = in_array($statusLama, $statusMengurangiStok);
                $sekarangMengurangi = in_array($statusBaru, $statusMengurangiStok);

                $bibit = Bibit::where('id', $pemesanan->bibit_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if (!$sebelumnyaMengurangi && $sekarangMengurangi) {

                    if ($pemesanan->jumlah_pesan > $bibit->stok_sekarang) {
                        throw new \Exception('Stok bibit tidak mencukupi untuk pesanan ini.');
                    }

                    $bibit->update([
                        'stok_sekarang' => $bibit->stok_sekarang - $pemesanan->jumlah_pesan,
                    ]);
                }

                if ($sebelumnyaMengurangi && !$sekarangMengurangi) {
                    $bibit->update([
                        'stok_sekarang' => $bibit->stok_sekarang + $pemesanan->jumlah_pesan,
                    ]);
                }

                $pemesanan->update([
                    'status' => $statusBaru,
                ]);
            });

            return redirect()
                ->route('admin.pemesanan.index')
                ->with('success', 'Status pemesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'status' => $e->getMessage(),
                ]);
        }
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index');
    }
}
