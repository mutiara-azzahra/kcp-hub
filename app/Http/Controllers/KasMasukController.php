<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KasMasukHeader;
use App\Models\KasMasukDetails;
use App\Models\MasterKodeRak;
use App\Models\MasterOutlet;
use App\Models\MasterPerkiraan;
use App\Models\TransaksiAkuntansiJurnalHeader;
use App\Models\TransaksiAkuntansiJurnalDetails;

class KasMasukController extends Controller
{
    public function index(){

        $belum_selesai  = KasMasukHeader::orderBy('created_at', 'desc')->where('status', 'O')->get();
        $selesai        = KasMasukHeader::orderBy('created_at', 'desc')->where('status', 'C')->get();

        return view('kas-masuk.index', compact('belum_selesai', 'selesai'));
    }

    public function bukti_bayar(){

        $master_outlet = MasterOutlet::where('status', 'Y')->get();

        return view('kas-masuk.create', compact('master_outlet'));
    }
    public function bayar_manual(){

        $master_outlet = MasterOutlet::where('status', 'Y')->get();

        return view('kas-masuk.bayar-manual', compact('master_outlet'));
    }

    public function store_bukti_bayar(Request $request){

        $request -> validate([
            'tanggal_rincian_tagihan'   => 'required',
            'pembayaran_via'            => 'required',
        ]);

        $newKas                 = new KasMasukHeader();
        $newKas->no_kas_masuk   = KasMasukHeader::no_kas_masuk();

        $request->merge([
            'terima_dari'       => $request->terima_dari,
            'keterangan'        => $request->keterangan,
            'no_kas_masuk'      => $newKas->no_kas_masuk,
            'status'            => 'O',
            'flag_kas_manual'   => 'Y',
            'created_by'        => Auth::user()->nama_user
        ]);

        $created = KasMasukHeader::create($request->all());

        if ($created){
            return redirect()->route('kas-masuk.details', ['no_kas_masuk' => $newKas->no_kas_masuk])->with('success', 'Bukti bayar baru berhasil ditambahkan');
        } else{
            return redirect()->route('kas-masuk.index')->with('danger','Bukti bayar baru gagal ditambahkan');
        }
    }


    public function details($no_kas_masuk){

        $debet  = MasterPerkiraan::where('sts_perkiraan', 'D')->get();
        $kredit = MasterPerkiraan::where('sts_perkiraan', 'K')->get();

        $kas_masuk = KasMasukHeader::where('no_kas_masuk', $no_kas_masuk)->first();

        if (!$kas_masuk) {
            return redirect()->back()->with('warning', 'Nomor Kas masuk tidak ditemukan');
        }

        $balance_debet = $kas_masuk->details->where('akuntansi_to', 'D')->sum('total');
        $balance_kredit = $kas_masuk->details->where('akuntansi_to', 'K')->sum('total');

        $balancing = $balance_debet - $balance_kredit;

        return view('kas-masuk.details', compact('kas_masuk', 'debet', 'kredit', 'balancing'));
    }

   public function store(Request $request){

        $request -> validate([
            'tanggal_rincian_tagihan'   => 'required', 
            'kd_outlet'                 => 'required', 
            'pembayaran_via'            => 'required',
            'nominal'                   => 'required',
        ]);

        $newKas                 = new KasMasukHeader();
        $newKas->no_kas_masuk   = KasMasukHeader::no_kas_masuk();
        
        $request->merge([
            'terima_dari'       => $request->terima_dari,
            'keterangan'        => $request->keterangan,
            'no_bg'             => $request->no_bg,
            'jatuh_tempo_bg'    => $request->jatuh_tempo_bg,
            'no_kas_masuk'      => $newKas->no_kas_masuk,
            'nominal'           => $request->nominal,
            'status'            => 'O',
            'created_by'        => Auth::user()->nama_user
        ]);

        $created = KasMasukHeader::create($request->all());

        //JURNAL HEADER KAS MASUK CASH
        $data['trx_date']   = now();
        $data['trx_from']   = $request->no_kas_masuk;
        $data['keterangan'] = $request->keterangan;
        $data['trx_from']   = $request->no_kas_masuk;

        $created = TransaksiAkuntansiJurnalHeader::create($data);

        //DEBET
        $debet['id_header']  = $created->id;
        $debet['perkiraan']  = 1.1101;
        $debet['debet']      = $request->nominal;
        $debet['kredit']     = 0;

        $created = TransaksiAkuntansiJurnalDetails::create($debet);

        //KREDIT
        $debet['id_header']  = $created->id;
        $debet['perkiraan']  = 2.1702;
        $debet['debet']      = 0;
        $debet['kredit']     = $request->nominal;

        $created = TransaksiAkuntansiJurnalDetails::create($debet);

        if ($created){
            return redirect()->route('kas-masuk.index')->with('success','Kas masuk berhasil ditambahkan');
        } else{
            return redirect()->route('kas-masuk.index')->with('danger','Kas masuk gagal ditambahkan');
        }
    }

    public function store_details(Request $request){

        $request->validate([
            'no_kas_masuk' => 'required',
            'perkiraan'    => 'required',
            'akuntansi_to' => 'required',
            'total'        => 'required',
        ]);
    
        $perkiraan = MasterPerkiraan::findOrFail($request['perkiraan']);
    
        KasMasukDetails::create([
            'no_kas_masuk'  => $request['no_kas_masuk'],
            'perkiraan'     => $perkiraan->id_perkiraan,
            'sub_perkiraan' => $perkiraan->sub_perkiraan,
            'akuntansi_to'  => $request['akuntansi_to'],
            'total'         => $request['total'],
            'created_at'    => NOW(),
        ]);
            
        return redirect()->route('kas-masuk.details', ['no_kas_masuk' => $request->no_kas_masuk])->with('success','Data kas masuk baru berhasil ditambahkan!');
    }

    public function cetak_tanda_terima($no_kas_masuk)
    {

        $update_header = KasMasukHeader::where('no_kas_masuk', $no_kas_masuk)
            ->update([
            'status'        => 'C',
            'updated_at'    => NOW(),
            'updated_by'    => Auth::user()->nama_user
        ]);

        $update_details = KasMasukDetails::where('no_kas_masuk', $no_kas_masuk)
            ->update([
            'status'        => 'C',
            'updated_at'    => NOW(),
            'updated_by'    => Auth::user()->nama_user
        ]);
        
        $data  = KasMasukHeader::where('no_kas_masuk', $no_kas_masuk)->first();
        $pdf   = PDF::loadView('reports.kas-masuk', ['data'=> $data]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('kas-masuk.pdf');
    }

    public function cetak($no_kas_masuk)
    {
        $data  = KasMasukHeader::where('no_kas_masuk', $no_kas_masuk)->first();
        $pdf   = PDF::loadView('reports.kas-masuk', ['data'=> $data]);
        $pdf->setPaper('letter', 'potrait');

        return $pdf->stream('kas-masuk.pdf');
    }

    public function delete_details($id)
    {
        try {

            $detail_kas_masuk = KasMasukDetails::findOrFail($id);
            $detail_kas_masuk->delete();

            return redirect()->route('kas-masuk.details', ['no_kas_masuk' => $detail_kas_masuk->no_kas_masuk])->with('success', 'Data kas masuk berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('kas-masuk.details', ['no_kas_masuk' => $detail_kas_masuk->no_kas_masuk])->with('danger', 'Terjadi kesalahan saat menghapus data Kas masuk.');
        }
    }

    

}
