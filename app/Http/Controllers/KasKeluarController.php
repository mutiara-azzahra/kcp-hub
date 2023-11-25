<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\Models\TransaksiKasKeluarHeader;
use App\Models\TransaksiKasKeluarDetails;
use App\Models\MasterPerkiraan;


class KasKeluarController extends Controller
{
    public function index(){

        $kas_keluar = TransaksiKasKeluarHeader::all();

        return view('kas-keluar.index', compact('kas_keluar'));
    }

    public function create(){

        return view('kas-keluar.create');
    }

    public function store(Request $request){

        $request -> validate([
            'trx_date'   => 'required',
            'keterangan'          => 'required',
        ]);

        $newKeluar              = new TransaksiKasKeluarHeader();
        $newKeluar->no_keluar   = TransaksiKasKeluarHeader::no_keluar();
        
        $request->merge([
            'no_keluar'         => $newKeluar->no_keluar,
            'trx_date'          => $request->trx_date,
            'pembayaran'        => $request->pembayaran,
            'keterangan'        => $request->keterangan,
            'status'            => 'A',
            'created_by'        => Auth::user()->nama_user
        ]);

        $created = TransaksiKasKeluarHeader::create($request->all());

        if ($created){
            return redirect()->route('kas-keluar.details', ['no_keluar' => $newKeluar->no_keluar])->with('success', 'Bukti bayar baru berhasil ditambahkan');
        } else{
            return redirect()->route('kas-keluar.index')->with('danger','Kas Keluar baru gagal ditambahkan');
        }
    }

    public function details($no_keluar){

        $perkiraan  = MasterPerkiraan::all();
        $kas_keluar = TransaksiKasKeluarHeader::where('no_keluar', $no_keluar)->first();

       return view('kas-keluar.details', compact('kas_keluar', 'perkiraan'));
      
   }

   public function store_details(Request $request){

        $request->validate([
            'inputs.*.no_keluar'    => 'required',
            'inputs.*.perkiraan'    => 'required',
            'inputs.*.akuntansi_to' => 'required',
            'inputs.*.total'        => 'required',
        ]);
        
        foreach ($request->inputs as $key => $value) {
            $perkiraan = MasterPerkiraan::findOrFail($value['perkiraan']);
        
            TransaksiKasKeluarDetails::create([
                'no_keluar'     => $value['no_keluar'],
                'perkiraan'     => $perkiraan ? $perkiraan->perkiraan . '.' . $perkiraan->sub_perkiraan : null,
                'akuntansi_to'  => $value['akuntansi_to'],
                'total'         => $value['total'],
                'created_at'    => NOW(),
            ]);
        }
            
        return redirect()->route('kas-keluar.index')->with('success','Data kas masuk baru berhasil ditambahkan!');
    
    }

    public function show($no_keluar){

        $kas_keluar = TransaksiKasKeluarHeader::where('no_keluar', $no_keluar)->first();

       return view('kas-keluar.view', compact('kas_keluar'));
    }

}
