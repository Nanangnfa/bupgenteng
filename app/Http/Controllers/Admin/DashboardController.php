<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bibit;
use App\Models\Monitoring;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Exports\LaporanBulananExport;
use Maatwebsite\Excel\Facades\Excel;

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
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);

        $bulan = (int) $request->bulan;
        $tahun = (int) $request->tahun;

        $namaBulan = [
            1 => 'januari',
            2 => 'februari',
            3 => 'maret',
            4 => 'april',
            5 => 'mei',
            6 => 'juni',
            7 => 'juli',
            8 => 'agustus',
            9 => 'september',
            10 => 'oktober',
            11 => 'november',
            12 => 'desember',
        ];

        $fileName = 'laporan_bup_genteng_' . $namaBulan[$bulan] . '_' . $tahun . '.xlsx';

        return Excel::download(new LaporanBulananExport($bulan, $tahun), $fileName);
    }
}




