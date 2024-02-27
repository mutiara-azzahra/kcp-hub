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

class TransferMasukController extends Controller
{
    public function index(){

        $tf_masuk = TransferMasukHeader::where('status_transfer', 'IN')->orderBy('created_at', 'desc')->get();
        $tf_masuk_validated = TransferMasukHeader::where('flag_kas_ar', 'Y')->orderBy('created_at', 'desc')->get();

        return view('transfer-masuk.index', compact('tf_masuk', 'tf_masuk_validated'));
    }

    public function create(){

        return view('transfer-masuk.create');
    }

    public function validasi(){

        $tf_kas = TransferMasukHeader::where('status_transfer', 'IN')->orderBy('id_transfer', 'desc')->get();

        return view('transfer-masuk.validasi', compact('tf_kas'));
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

        $debet  = MasterPerkiraan::where('sts_perkiraan', 'D')->get();
        $kredit = MasterPerkiraan::where('sts_perkiraan', 'K')->get();

        $transfer  = TransferMasukHeader::where('id_transfer
        ', $id_transfer)->first();

        if (!$transfer) {
            return redirect()->back()->with('warning', 'Nomor Kas masuk tidak ditemukan');
        }

        $balance_debet  = $transfer->details->where('akuntansi_to', 'D')->sum('total');
        $balance_kredit = $transfer->details->where('akuntansi_to', 'K')->sum('total');

        $balancing = $balance_debet - $balance_kredit;

        return view('transfer-masuk.details', compact('transfer', 'debet', 'kredit', 'balancing'));
    }

    public function validasi_data($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::where('id_transfer', $id_transfer)->get();

        return view('transfer-masuk.view', compact('transfer', 'kas_masuk'));
    }

    public function store_details(Request $request){

        $request->validate([
            'id_transfer'  => 'required',
            'perkiraan'    => 'required',
            'akuntansi_to' => 'required',
            'total'        => 'required',
        ]);
        
        $totalSum = 0;
        $id_transfer = null;
    
        $perkiraan = MasterPerkiraan::findOrFail($request['perkiraan']);
    
        TransferMasukDetails::create([
            'id_transfer'  => $request['id_transfer'],
            'perkiraan'     => $perkiraan ? $perkiraan->perkiraan . '.' . $perkiraan->sub_perkiraan : null,
            'sub_perkiraan' => $perkiraan->sub_perkiraan,
            'akuntansi_to'  => $request['akuntansi_to'],
            'total'         => $request['total'],
            'created_by'    => Auth::user()->nama_user,
        ]);
            
        return redirect()->route('transfer-masuk.index')->with('success','Data transfer baru berhasil ditambahkan!');
    }

    public function edit($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $check      = KasMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::all();
        $outlet     = MasterOutlet::where('status', 'Y')->get();

        return view('transfer-masuk.edit', compact('transfer', 'outlet', 'kas_masuk','check'));
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

        return redirect()->route('transfer-masuk.index')->with('success', 'Transfer masuk baru berhasil ditambahkan kedalam kas masuk');
    }

    public function store_validasi($id_transfer)
    {

        TransferMasukHeader::where('id_transfer', $id_transfer)->update([
            'flag_kas_ar'        => 'Y',
            'updated_at'         => NOW(),
            'updated_by'         => Auth::user()->nama_user
        ]);

        return redirect()->route('transfer-masuk.index')->with('success', 'Transfer masuk baru berhasil ditambahkan kedalam kas masuk');
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
