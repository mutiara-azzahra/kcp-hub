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

class KasMasukController extends Controller
{
    public function index(){

        $belum_selesai = KasMasukHeader::orderBy('no_kas_masuk', 'desc')->where('status', 'O')->get();

        $selesai = KasMasukHeader::orderBy('no_kas_masuk', 'desc')->where('status', 'C')->get();

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
            'kd_outlet'                 => 'required', 
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

        $perkiraan = MasterPerkiraan::all();
        $kas_masuk = KasMasukHeader::where('no_kas_masuk', $no_kas_masuk)->first();

       return view('kas-masuk.details', compact('kas_masuk', 'perkiraan'));
      
    }

   public function store(Request $request){

        $request -> validate([
            'tanggal_rincian_tagihan'   => 'required', 
            'kd_outlet'                 => 'required', 
            'pembayaran_via'            => 'required',
        ]);

        $newKas                 = new KasMasukHeader();
        $newKas->no_kas_masuk   = KasMasukHeader::no_kas_masuk();
        
        $request->merge([
            'terima_dari'       => $request->terima_dari,
            'keterangan'        => $request->keterangan,
            'no_kas_masuk'      => $newKas->no_kas_masuk,
            'status'            => 'O',
            'created_by'        => Auth::user()->nama_user
        ]);

        $created = KasMasukHeader::create($request->all());

        if ($created){
            return redirect()->route('kas-masuk.index')->with('success','Kas masuhk berhasil ditambahkan');
        } else{
            return redirect()->route('kas-masuk.index')->with('danger','Kas masuk gagal ditambahkan');
        }
    }

    public function store_details(Request $request){

        $request->validate([
            'inputs.*.no_kas_masuk' => 'required',
            'inputs.*.perkiraan'    => 'required',
            'inputs.*.akuntansi_to' => 'required',
            'inputs.*.total'        => 'required',
        ]);
        
        $totalSum = 0;
        $noKasMasuk = null; // Initialize the variable to hold no_kas_masuk value
    
        foreach ($request->inputs as $key => $value) {
            $perkiraan = MasterPerkiraan::findOrFail($value['perkiraan']);
        
            KasMasukDetails::create([
                'no_kas_masuk'  => $value['no_kas_masuk'],
                'perkiraan'     => $perkiraan ? $perkiraan->perkiraan . '.' . $perkiraan->sub_perkiraan : null,
                'sub_perkiraan' => $perkiraan->sub_perkiraan,
                'akuntansi_to'  => $value['akuntansi_to'],
                'total'         => $value['total'],
                'created_at'    => NOW(),
            ]);
    
            if ($value['akuntansi_to'] === 'D') {
                $totalSum += $value['total'];
            }

            if ($noKasMasuk === null) {
                $noKasMasuk = $value['no_kas_masuk'];
            }
        }
    
        if ($noKasMasuk !== null) {
            KasMasukHeader::where('no_kas_masuk', $noKasMasuk)->update([
                'nominal' => $totalSum,
            ]);
        }
            
        return redirect()->route('kas-masuk.index')->with('success','Data kas masuk baru berhasil ditambahkan!');
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

    

}
