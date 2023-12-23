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

    public function __construct($tanggal_awal, $tanggal_akhir, $no_faktur_pajak)
    {
        $this->tanggal_awal     = $tanggal_awal;
        $this->tanggal_akhir    = $tanggal_akhir;
        $this->no_faktur_pajak  = $no_faktur_pajak;
    }

    public function collection()
    {
        
        return TransaksiInvoiceHeader::whereBetween('created_at', [$this->tanggal_awal, $this->tanggal_akhir])->get()->map(function($item){
            $item->fk                       = 'FK';
            $item->kd_jenis_transaksi       = '01';
            $item->fg_pengganti             = '0';
            $item->nomor_faktur             = $this->no_faktur_pajak++;
            $item->masa_pajak               = Carbon::parse($item->created_at)->translatedFormat('m');
            $item->tahun_pajak              = Carbon::parse($item->created_at)->translatedFormat('Y');
            $item->tanggal_faktur           = Carbon::parse($item->created_at)->format('d/m/Y');
            $item->npwp                     = $item->outlet->no_npwp;
            $item->nama                     = $item->outlet->nik.'#NIK#NAMA#'.$item->outlet->nm_outlet;
            $item->alamat_lengkap           = $item->outlet->almt_outlet;
            $item->jumlah_dpp               = $item->details_invoice->sum('nominal_total')/1.11;
            $item->jumlah_ppn               = $item->details_invoice->sum('nominal_total')/1.11 * 0.11;            
            $item->jumlah_ppnbm             = '0';
            $item->id_keterangan_tambahan   = '0';
            $item->fg_uang_muka             = '0';
            $item->uang_muka_dpp            = '0';
            $item->uang_muka_ppn            = '0';
            $item->uang_muka_ppnbm          = '0';
            $item->referensi                = $item->noinv;
            $item->kode_dokumen_pendukung   = '';
         
            return $item->only(['fk','kd_jenis_transaksi','fg_pengganti','nomor_faktur','masa_pajak','tahun_pajak','tanggal_faktur',
                'npwp','nama','alamat_lengkap', 'jumlah_dpp','jumlah_ppn','jumlah_ppnbm','id_keterangan_tambahan', 'fg_uang_muka', 'uang_muka_dpp',
                'uang_muka_ppn', 'uang_muka_ppnbm', 'referensi', 'kode_dokumen_pendukung'
            ]);
        });

    }


    public function headings(): array
    {
        return [
            ['FK','KD_JENIS_TRANSAKSI','FG_PENGGANTI','NOMOR_FAKTUR','MASA_PAJAK','TAHUN_PAJAK','TANGGAL_FAKTUR',
                'NPWP','NAMA','ALAMAT_LENGKAP', 'JUMLAH_DPP','JUMLAH_PPN','JUMLAH_PPNBM','ID_KETERANGAN_TAMBAHAN', 'FG_UANG_MUKA', 'UANG_MUKA_DPP',
                'UANG_MUKA_PPN', 'UANG_MUKA_PPNBM', 'REFERENSI', 'KODE_DOKUMEN_PENDUKUNG'],
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
