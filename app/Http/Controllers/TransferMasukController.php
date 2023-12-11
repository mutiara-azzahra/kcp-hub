<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPerkiraan;
use App\Models\TransferMasukHeader;

class TransferMasukController extends Controller
{
    public function index(){

        $tf_masuk = TransferMasukHeader::where('status', 'A')->get();
        $tf_masuk_validated = TransferMasukHeader::where('flag_kas_ar', 'Y')->get();

        return view('transfer-masuk.index', compact('tf_masuk', 'tf_masuk_validated'));
    }

    public function create(){

        return view('transfer-masuk.create');
    }

    public function store(Request $request){

        $request->validate([
            'tanggal_bank'      => 'required',
            'bank'              => 'required',
            'dari_toko'         => 'required',
            'keterangan'        => 'required',
            'status_transfer'   => 'required',
        ]);
    
        $newTransfer = new TransferMasukHeader();
        $newTransfer->id_transfer = TransferMasukHeader::id_transfer();
    
        $status_transfer = '';
        $flag_by_toko = '';
    
        if ($request->status_transfer == 1) {
            $status_transfer = 'IN';
            $flag_by_toko = ($request->dari_toko == 1) ? 'Y' : 'N';
        } elseif ($request->status_transfer == 2) {
            $status_transfer = 'OUT';
            $flag_by_toko = 'N';
        }
    
        $requestData = [
            'id_transfer'       => $newTransfer->id_transfer,
            'status_transfer'   => $status_transfer,
            'tanggal_bank'      => $request->tanggal_bank,
            'bank'              => $request->bank,
            'flag_by_toko'      => $flag_by_toko,
            'keterangan'        => $request->keterangan,
            'status'            => 'O',
            'created_by'        => Auth::user()->nama_user
        ];
    
        $created = TransferMasukHeader::create($requestData);
    
        if ($created) {
            return redirect()->route('transfer-masuk.details', ['id_transfer' => $newTransfer->id_transfer])
                ->with('success', 'Transfer masuk berhasil ditambahkan. Tambahkan Details');
        } else {
            return redirect()->route('transfer-masuk.index')
                ->with('danger', 'Transfer masuk gagal ditambahkan');
        }
    }

    public function details($id_transfer){

        $perkiraan = MasterPerkiraan::all();
        $transfer  = TransferMasukHeader::where('id_transfer', $id_transfer)->first();

        return view('transfer-masuk.details', compact('perkiraan', 'transfer'));
    }

    public function store_details(Request $request){

        $request->validate([
                'inputs.*.kode_kabupaten'  => 'required',
                'inputs.*.id_sales'        => 'required',
        ]);

        foreach($request->inputs as $key => $value){

            $value['kode_kabupaten']    = $value['kode_kabupaten'];
            $value['id_sales']          = $value['id_sales'];
            $value['crea_date']         = NOW();
            $value['crea_by']           = Auth::user()->nama_user;

           MasterAreaSales::create($value);
        }        
        
        return redirect()->route('transfer-masuk.index')->with('success','Data area sales berhasil ditambahkan!');

    }

    public function delete($id)
    {
        $updated = MasterSales::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('transfer-masuk.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('transfer-masuk.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    
}
