<?php

namespace App\Exports;

use App\Models\Bibit;
use App\Models\Monitoring;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class LaporanBulananExport implements FromArray, WithColumnWidths, WithEvents, WithTitle
{
  protected int $bulan;
  protected int $tahun;
  protected Carbon $startDate;
  protected Carbon $endDate;

  protected array $namaBulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
  ];

  public function __construct(int $bulan, int $tahun)
  {
    $this->bulan = $bulan;
    $this->tahun = $tahun;

    $this->startDate = Carbon::create($tahun, $bulan, 1)->startOfMonth();
    $this->endDate = Carbon::create($tahun, $bulan, 1)->endOfMonth();
  }

  public function title(): string
  {
    return $this->namaBulan[$this->bulan] . ' ' . $this->tahun;
  }

  public function array(): array
  {
    $rows = [];

    $rows[] = ['LAPORAN PRODUKSI BIBIT IKAN BUP GENTENG'];
    $rows[] = ['Bulan', $this->namaBulan[$this->bulan]];
    $rows[] = ['Tahun', $this->tahun];
    $rows[] = ['Periode', $this->startDate->format('d-m-Y') . ' s/d ' . $this->endDate->format('d-m-Y')];
    $rows[] = [];

    $rows[] = [
      'No',
      'Kode Bibit',
      'Nama Ikan',
      'Ukuran',
      'Harga',
      'Stok Awal Bulan',
      'Jumlah Mati',
      'Jumlah Keluar/Pemesanan',
      'Stok Akhir Bulan',
      'Keterangan',
    ];

    $bibits = Bibit::orderBy('nama_ikan')->get();

    $totalStokAwal = 0;
    $totalJumlahMati = 0;
    $totalJumlahKeluar = 0;
    $totalStokAkhir = 0;

    foreach ($bibits as $index => $bibit) {
      $jumlahMati = Monitoring::where('bibit_id', $bibit->id)
        ->whereBetween('tanggal_monitoring', [
          $this->startDate->format('Y-m-d'),
          $this->endDate->format('Y-m-d'),
        ])
        ->sum('jumlah_mati');

      $jumlahKeluar = Pemesanan::where('bibit_id', $bibit->id)
        ->whereIn('status', ['disetujui', 'selesai'])
        ->whereBetween('updated_at', [
          $this->startDate,
          $this->endDate,
        ])
        ->sum('jumlah_pesan');

      $stokAkhir = $bibit->stok_sekarang ?? 0;

      $stokAwal = $stokAkhir + $jumlahMati + $jumlahKeluar;

      if ($stokAkhir <= 0) {
        $keterangan = 'Habis';
      } elseif ($jumlahMati > 0 && $jumlahKeluar > 0) {
        $keterangan = 'Ada kematian bibit dan pemesanan';
      } elseif ($jumlahMati > 0) {
        $keterangan = 'Ada kematian bibit';
      } elseif ($jumlahKeluar > 0) {
        $keterangan = 'Ada pemesanan';
      } else {
        $keterangan = 'Tersedia';
      }

      $rows[] = [
        $index + 1,
        $bibit->kode_bibit ?? '-',
        $bibit->nama_ikan ?? '-',
        $bibit->ukuran ?? '-',
        $bibit->harga ? (float) $bibit->harga : 0,
        $stokAwal,
        $jumlahMati,
        $jumlahKeluar,
        $stokAkhir,
        $keterangan,
      ];

      $totalStokAwal += $stokAwal;
      $totalJumlahMati += $jumlahMati;
      $totalJumlahKeluar += $jumlahKeluar;
      $totalStokAkhir += $stokAkhir;
    }

    $rows[] = [];

    $rows[] = [
      'TOTAL',
      '',
      '',
      '',
      '',
      $totalStokAwal,
      $totalJumlahMati,
      $totalJumlahKeluar,
      $totalStokAkhir,
      '',
    ];

    return $rows;
  }

  public function columnWidths(): array
  {
    return [
      'A' => 6,
      'B' => 22,
      'C' => 20,
      'D' => 16,
      'E' => 16,
      'F' => 18,
      'G' => 16,
      'H' => 24,
      'I' => 18,
      'J' => 30,
    ];
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $sheet = $event->sheet->getDelegate();
        $highestRow = $sheet->getHighestRow();

        $sheet->mergeCells('A1:J1');

        $sheet->getStyle('A1')->applyFromArray([
          'font' => [
            'bold' => true,
            'size' => 14,
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
          ],
        ]);

        $sheet->getStyle('A2:B4')->applyFromArray([
          'font' => [
            'bold' => true,
          ],
        ]);

        $sheet->getStyle('A6:J6')->applyFromArray([
          'font' => [
            'bold' => true,
            'color' => [
              'rgb' => 'FFFFFF',
            ],
          ],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
              'rgb' => '1F4E79',
            ],
          ],
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
          ],
        ]);

        $sheet->getStyle('A6:J' . $highestRow)->applyFromArray([
          'borders' => [
            'allBorders' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => [
                'rgb' => '000000',
              ],
            ],
          ],
        ]);

        $sheet->getStyle('A7:A' . $highestRow)
          ->getAlignment()
          ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('E7:E' . $highestRow)
          ->getNumberFormat()
          ->setFormatCode('"Rp" #,##0');

        $sheet->getStyle('F7:I' . $highestRow)
          ->getNumberFormat()
          ->setFormatCode('#,##0');

        $sheet->getStyle('A' . $highestRow . ':J' . $highestRow)->applyFromArray([
          'font' => [
            'bold' => true,
          ],
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => [
              'rgb' => 'D9EAF7',
            ],
          ],
        ]);

        $sheet->getStyle('A1:J' . $highestRow)
          ->getAlignment()
          ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->getStyle('B7:J' . $highestRow)
          ->getAlignment()
          ->setWrapText(true);

        $sheet->freezePane('A7');

        $sheet->getPageSetup()
          ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $sheet->getPageSetup()->setFitToWidth(1);
      },
    ];
  }
}
