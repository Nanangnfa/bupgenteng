<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bibit;
use App\Models\Monitoring;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBibit = Bibit::count();
        $totalStok = Bibit::sum('stok_sekarang');
        $pesananPending = Pemesanan::where('status', 'pending')->count();
        $totalMonitoring = Monitoring::count();

        return view('admin.dashboard', compact(
            'totalBibit',
            'totalStok',
            'pesananPending',
            'totalMonitoring'
        ));
    }

    public function showCreateReportForm()
    {
        return view('admin.report.create'); // blade untuk pilih periode
    }

    public function exportReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
        $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();

        $startFile = $startDate->format('Y-m-d');
        $endFile = $endDate->format('Y-m-d');

        $bibit = Bibit::whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $monitoring = Monitoring::with('bibit')
            ->whereBetween('tanggal_monitoring', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->latest()
            ->get();

        $pemesanan = Pemesanan::with('bibit')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="report_' . $startFile . '_to_' . $endFile . '.csv"',
        ];

        $callback = function () use ($bibit, $monitoring, $pemesanan, $startFile, $endFile) {
            $file = fopen('php://output', 'w');

            // BOM agar Excel membaca UTF-8 dengan benar
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Agar Excel memisahkan kolom dengan titik koma
            fwrite($file, "sep=;\n");

            fputcsv($file, ['LAPORAN DATA BUP GENTENG'], ';');
            fputcsv($file, ['Periode', $startFile . ' sampai ' . $endFile], ';');
            fputcsv($file, [], ';');

            /*
        |--------------------------------------------------------------------------
        | DATA BIBIT
        |--------------------------------------------------------------------------
        */
            fputcsv($file, ['DATA BIBIT'], ';');
            fputcsv($file, [
                'No',
                'Kode Bibit',
                'Nama Ikan',
                'Jumlah Awal',
                'Stok Sekarang',
                'Status',
                'Deskripsi',
                'Tanggal Input',
            ], ';');

            foreach ($bibit as $index => $b) {
                fputcsv($file, [
                    $index + 1,
                    $b->kode_bibit ?? '-',
                    $b->nama_ikan ?? '-',
                    $b->jumlah_awal ?? '-',
                    $b->stok_sekarang ?? '-',
                    $b->status ?? '-',
                    $b->deskripsi ?? '-',
                    optional($b->created_at)->format('d-m-Y H:i'),
                ], ';');
            }

            fputcsv($file, [], ';');
            fputcsv($file, [], ';');

            /*
        |--------------------------------------------------------------------------
        | DATA MONITORING
        |--------------------------------------------------------------------------
        */
            fputcsv($file, ['DATA MONITORING'], ';');
            fputcsv($file, [
                'No',
                'Tanggal Monitoring',
                'Kode Bibit',
                'Nama Ikan',
                'Jumlah Mati',
                'Stok Setelah Monitoring',
                'Catatan',
                'Tanggal Input',
            ], ';');

            foreach ($monitoring as $index => $m) {
                fputcsv($file, [
                    $index + 1,
                    $m->tanggal_monitoring ?? '-',
                    $m->bibit->kode_bibit ?? '-',
                    $m->bibit->nama_ikan ?? '-',
                    $m->jumlah_mati ?? 0,
                    $m->stok_akhir ?? 0,
                    $m->catatan ?? '-',
                    optional($m->created_at)->format('d-m-Y H:i'),
                ], ';');
            }

            fputcsv($file, [], ';');
            fputcsv($file, [], ';');

            /*
        |--------------------------------------------------------------------------
        | DATA PEMESANAN
        |--------------------------------------------------------------------------
        */
            fputcsv($file, ['DATA PEMESANAN'], ';');
            fputcsv($file, [
                'No',
                'Kode Pemesanan',
                'Nama Customer',
                'No WhatsApp',
                'Alamat',
                'Kode Bibit',
                'Nama Ikan',
                'Jumlah Pesan',
                'Status',
                'Catatan',
                'Tanggal Pesan',
            ], ';');

            foreach ($pemesanan as $index => $p) {
                fputcsv($file, [
                    $index + 1,
                    $p->kode_pemesanan ?? '-',
                    $p->nama_customer ?? '-',
                    $p->no_whatsapp ?? '-',
                    $p->alamat ?? '-',
                    $p->bibit->kode_bibit ?? '-',
                    $p->bibit->nama_ikan ?? '-',
                    $p->jumlah_pesan ?? 0,
                    $p->status ?? '-',
                    $p->catatan ?? '-',
                    optional($p->created_at)->format('d-m-Y H:i'),
                ], ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}




