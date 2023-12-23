<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\TransaksiInvoiceHeader;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPajak implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($tanggal_awal, $tanggal_akhir)
    {
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function collection()
    {
        // return TransaksiInvoiceHeader::all();
        
        return TransaksiInvoiceHeader::whereBetween('created_at', [$this->tanggal_awal, $this->tanggal_akhir])->get()->map(function($item){
            $item->fk                       = '-';
            $item->kd_jenis_transaksi       = $item->id_transaksi_pembayaran;
            $item->fg_pengganti             = $item->pemohon->nama_kepala_keluarga;
            $item->nomor_faktur             = $item->ruangan->lantai->gedung->nama_gedung;
            $item->masa_pajak               = $item->ruangan->lantai->lantai;
            $item->tahun_pajak              = $item->ruangan->no_ruangan;
            $item->tanggal_faktur           = 'Rp. '.$item->ruangan->harga_ruangan;
            $item->npwp                     = $item->detail_transaksi_pembayaran->implode('bulan',',');
            $item->nama                     = Carbon::parse($item->created_at)->translatedFormat('Y');
            $item->alamat_lengkap           = Carbon::parse($item->created_at)->translatedFormat('d F Y');
            $item->jumlah_dpp               = Carbon::parse($item->created_at)->translatedFormat('Y');
            $item->jumlah_ppn               = $item->detail_transaksi_pembayaran->count();
            $item->jumlah_ppnbm             = 'Rp. '.$item->ruangan->harga_ruangan;
            $item->id_keterangan_tambahan   = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
            $item->fg_uang_muka             = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
            $item->uang_muka_dpp            = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
            $item->uang_muka_ppn            = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
            $item->uang_muka_ppnbm          = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
            $item->referensi                = 'Rp. '.$item->detail_transaksi_pembayaran->sum('harga');
         
            return $item->only(['fk','kd_jenis_transaksi','fg_pengganti','nomor_faktur','masa_pajak','tahun_pajak','tanggal_faktur',
            'npwp','nama','alamat_lengkap', 'jumlah_dpp','jumlah_ppn','jumlah_ppnbm','id_keterangan_tambahan', 'fg_uang_muka', 'uang_muka_dpp',
            'uang_muka_ppn', 'uang_muka_ppnbm', 'referensi'
            ]);
        });
    }


    public function headings(): array
    {
        return [
            ['FK','KD_JENIS_TRANSAKSI','FG_PENGGANTI','NOMOR_FAKTUR','MASA_PAJAK','TAHUN_PAJAK','TANGGAL_FAKTUR',
                'NPWP','NAMA','ALAMAT_LENGKAP', 'JUMLAH_DPP','JUMLAH_PPN','JUMLAH_PPNBM','ID_KETERANGAN_TAMBAHAN', 'FG_UANG_MUKA', 'UANG_MUKA_DPP',
                'UANG_MUKA_PPN', 'UANG_MUKA_PPNBM', 'REFERENSI'],
            ['LT','NPWP','NAMA','JALAN','BLOK','NOMOR','RT','RW','KECAMATAN','KELURAHAN', 'KABUPATEN','PROPINSI','KODE_POS','NOMOR_TELEPON'],
            ['OF','KODE_OBJEK','NAMA','HARGA_SATUAN','JUMLAH_BARANG','HARGA_TOTAL','DISKON','DPP','PPN','TARIF_PPNBM', 'PPNBM'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $count = $this->collection()->count();
        $count = $count + 5;
        $cell   = 'A4:N' . $count;

        $sheet->mergeCells('A1:N1');
        $sheet->mergeCells('A2:N2');
        
        $sheet->getStyle('A1:N1')->applyFromArray(['aligment' => ['horizontal' => 'center']]);
        $sheet->getStyle('A2:N2')->applyFromArray(['aligment' => ['horizontal' => 'center']]);

        $sheet->getStyle('A4:N4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('F07470');

        return [
            $cell => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ]
                ]
            ],
        ];
    }

    
}
