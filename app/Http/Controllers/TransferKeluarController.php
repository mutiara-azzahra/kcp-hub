<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterPerkiraan;
use App\Models\KasMasukHeader;
use App\Models\MasterOutlet;
use App\Models\TransferMasukHeader;
use App\Models\TransferMasukDetails;

class TransferKeluarController extends Controller
{
    public function index(){

        $tf_keluar = TransferMasukHeader::where('status_transfer', 'OUT')->orderBy('created_at', 'desc')->get();

        return view('transfer-keluar.index', compact('tf_keluar'));
    }

    public function create(){

        return view('transfer-keluar.create');
    }

    public function validasi(){

        $tf_kas = TransferMasukHeader::where('status_transfer', 'IN')->orderBy('id_transfer', 'desc')->get();

        return view('transfer-keluar.validasi', compact('tf_kas'));
    }

    public function store(Request $request){

        $request->validate([
            'tanggal_bank'      => 'required',
            'bank'              => 'required',
            'keterangan'        => 'required',
        ]);
    
        $newTransfer              = new TransferMasukHeader();
        $newTransfer->id_transfer = TransferMasukHeader::id_transfer();
        
        $status_transfer = 'OUT';
       
        $requestData = [
            'id_transfer'       => $newTransfer->id_transfer,
            'status_transfer'   => $status_transfer,
            'tanggal_bank'      => $request->tanggal_bank,
            'bank'              => $request->bank,
            'flag_by_toko'      => 'N',
            'flag_kas_ar'       => 'N',
            'keterangan'        => $request->keterangan,
            'status'            => 'O',
            'created_by'        => Auth::user()->nama_user
        ];
    
        $created = TransferMasukHeader::create($requestData);
    
        if ($created) {
            return redirect()->route('transfer-keluar.details', ['id_transfer' => $newTransfer->id_transfer])
                ->with('success', 'Transfer keluar berhasil ditambahkan. Tambahkan Details Transfer!');
        } else {
            return redirect()->route('transfer-keluar.index')
                ->with('danger', 'Transfer keluar gagal ditambahkan');
        }
    }

    public function details($id_transfer){

        $perkiraan  = MasterPerkiraan::where('status', 'AKTIF')->get();
        $transfer  = TransferMasukHeader::where('id_transfer', $id_transfer)->first();

        $balance_debet  = $transfer->details->where('akuntansi_to', 'D')->sum('total');
        $balance_kredit = $transfer->details->where('akuntansi_to', 'K')->sum('total');

        $balancing  = $balance_debet - $balance_kredit;

        return view('transfer-keluar.details', compact('perkiraan', 'transfer', 'balancing'));
    }

    public function validasi_data($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::where('id_transfer', $id_transfer)->get();

        return view('transfer-keluar.view', compact('transfer', 'kas_masuk'));
    }

    public function store_details(Request $request){

        $request->validate([
            'id_transfer'  => 'required',
            'perkiraan'    => 'required',
            'akuntansi_to' => 'required',
            'total'        => 'required',
        ]);
        
        $perkiraan = MasterPerkiraan::findOrFail($request['perkiraan']);
    
        TransferMasukDetails::create([
            'id_transfer'   => $request['id_transfer'],
            'perkiraan'     => $perkiraan->id_perkiraan,
            'sub_perkiraan' => $perkiraan->sub_perkiraan,
            'akuntansi_to'  => $request['akuntansi_to'],
            'total'         => $request['total'],
            'created_by'    => Auth::user()->nama_user,
            'created_at'    => now()
        ]);

            
        return redirect()->route('transfer-keluar.details', ['id_transfer' => $request['id_transfer']])
            ->with('success','Data detail transfer baru berhasil ditambahkan!');
            
        return redirect()->route('transfer-keluar.index')->with('success','Data transfer baru berhasil ditambahkan!');
    }

    public function edit($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $check      = KasMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::all();
        $outlet     = MasterOutlet::where('status', 'Y')->get();

        return view('transfer-keluar.edit', compact('transfer', 'outlet', 'kas_masuk','check'));
    }

    public function store_transfer(Request $request)
    {

        $id_transfer     = $request->input('id_transfer');

        $selectedItems  = $request->input('selected_items', []);

        for ($i = 0; $i < count($selectedItems); $i++) {
            $itemKasMasuk = $selectedItems[$i];

            KasMasukHeader::where('no_kas_masuk', $itemKasMasuk)->update([
                'id_transfer'        => $request->id_transfer,
                'updated_at'         => NOW(),
                'updated_by'         => Auth::user()->nama_user
            ]);

        }

        return redirect()->route('transfer-keluar.index')->with('success', 'Transfer keluar baru berhasil ditambahkan kedalam kas keluar');
    }

    public function store_validasi($id_transfer)
    {

        TransferMasukHeader::where('id_transfer', $id_transfer)->update([
            'flag_kas_ar'        => 'Y',
            'updated_at'         => NOW(),
            'updated_by'         => Auth::user()->nama_user
        ]);

        return redirect()->route('transfer-keluar.index')->with('success', 'Transfer keluar baru berhasil ditambahkan kedalam kas keluar');
    }

    public function delete($id)
    {
        try {

            $transfer   = TransferMasukHeader::findOrFail($id);
            $transfer->delete();

            $datails    = TransferMasukDetails::where('id_transfer', $transfer->id_transfer)->delete();

            return redirect()->route('transfer-keluar.details', ['id_transfer' => $transfer->id_transfer])->with('success', 'Data transfer keluar berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('transfer-keluar.details', ['id_transfer' => $transfer->id_transfer])->with('danger', 'Terjadi kesalahan saat menghapus data transfer keluar.');
        }
    }


    public function delete_details($id)
    {
        try {

            $transfer = TransferMasukDetails::findOrFail($id);
            $transfer->delete();

            return redirect()->route('transfer-keluar.details', ['id_transfer' => $transfer->id_transfer])->with('success', 'Data transfer keluar berhasil dihapus!');

        } catch (\Exception $e) {

            return redirect()->route('transfer-keluar.details', ['id_transfer' => $transfer->id_transfer])->with('danger', 'Terjadi kesalahan saat menghapus data transfer keluar.');
        }
    }

    
}
