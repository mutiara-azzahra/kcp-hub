<?php

namespace App\Exports;

use App\Models\TransaksiInvoiceHeader;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ExportPajak implements FromCollection, WithCustomCsvSettings
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
        $headers = TransaksiInvoiceHeader::whereBetween('created_at', [$this->tanggal_awal, $this->tanggal_akhir])->get();

        $data = [];

        $data = [
            [
                'FK;KD_JENIS_TRANSAKSI;FG_PENGGANTI;NOMOR_FAKTUR;MASA_PAJAK;TAHUN_PAJAK;TANGGAL_FAKTUR;NPWP;NAMA;ALAMAT_LENGKAP;JUMLAH_DPP;JUMLAH_PPN;JUMLAH_PPNBM;ID_KETERANGAN_TAMBAHAN;FG_UANG_MUKA;UANG_MUKA_DPP;UANG_MUKA_PPN;UANG_MUKA_PPNBM;REFERENSI',
            ],
            [
                'LT;NPWP;NAMA;JALAN;BLOK;NOMOR;RT;RW;KECAMATAN;KELURAHAN;KABUPATEN;PROPINSI;KODE_POS;NOMOR_TELEPON',
            ],
            [
                'OF;KODE_OBJEK;NAMA;HARGA_SATUAN;JUMLAH_BARANG;HARGA_TOTAL;DISKON;DPP;PPN;TARIF_PPNBM;PPNBM',
            ],
        ];

        foreach ($headers as $header) {
            
            $no_npwp = '';

            if($header->outlet->no_npwp != null){
                $no_npwp = $header->outlet->no_npwp;
            } else {
                $no_npwp = '000000000000000';
            }

            $headerData = [
                'FK;01;0;' . $this->no_faktur_pajak++ . ';' . Carbon::parse($header->created_at)->format('m') . ';' .
                Carbon::parse($header->created_at)->format('Y') . ';' . Carbon::parse($header->created_at)->format('d/m/Y') . ';'.
                $no_npwp . ';' . $header->outlet->nik . '#NIK#NAMA#' . $header->outlet->nm_outlet . ';' .
                $header->outlet->almt_outlet . ';' . $header->details_invoice->sum('nominal_total') / 1.11 . ';' .
                ($header->details_invoice->sum('nominal_total') / 1.11 * 0.11) . ';0;0;0;0;0;0;' . $header->noinv
            ];

            $data[] = $headerData;

            foreach ($header->details_invoice as $detail) {
                $detailData = [
                    'OF;' . $detail->part_no . ';' . $detail->nama_part->part_nama . ';' . $detail->hrg_pcs . ';'. $detail->qty .';'.
                     $detail->qty * $detail->hrg_pcs/1.11 .';'. $detail->qty * $detail->hrg_pcs * $detail->disc/100 /1.11 . ';'.
                      $detail->nominal_total/1.11 . ';'. $detail->nominal_total/1.11 * 0.11
                ];
                
                $data[] = $detailData;
            }
        }

        return collect($data);
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

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    
}
