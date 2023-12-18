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
use App\Models\BgMasukHeader;
use App\Models\BgMasukDetails;


class BGMasukController extends Controller
{
    public function index(){

        $bg_gantung = KasMasukHeader::where('pembayaran_via', 'BG')->orderBy('created_at', 'desc')->get();
        $bg_cair    = BgMasukHeader::orderBy('created_at', 'desc')->get();

        return view('bg-masuk.index', compact('bg_gantung', 'bg_cair'));
    }

    public function store($no_bg){

        $bg             = KasMasukHeader::where('no_bg', $no_bg)->first();
        $newBg          = new BgMasukHeader();
        $newBg->id_bg   = BgMasukHeader::id_bg();
    
        $requestData = [
            'id_bg'                 => $newBg->id_bg,
            'status_bg'             => 'IN',
            'from_bg'               => $bg->no_bg,
            'keterangan'            => $bg->no_bg.'/'.$bg->bank,
            'nominal'               => $bg->nominal,
            'status'                => 'C',
            'flag_balik'            => 'N',
            'flag_batal'            => 'N',
            'created_by'            => Auth::user()->nama_user
        ];
    
        $created = BgMasukHeader::create($requestData);
    
        if ($created) {
            return redirect()->route('bg-masuk.index')->with('success', 'BG masuk berhasil dicairkan');
        } else {
            return redirect()->route('bg-masuk.index')->with('danger', 'BG masuk gagal ditambahkan');
        }
    }

    public function details($id){

        $perkiraan  = MasterPerkiraan::all();
        $header     = BgMasukHeader::where('id', $id)->first();

        return view('bg-masuk.details', compact('perkiraan', 'header'));
    }

    public function validasi_data($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::where('id_transfer', $id_transfer)->get();

        return view('bg-masuk.view', compact('transfer', 'kas_masuk'));
    }

    public function store_details(Request $request){

        $request->validate([
            'inputs.*.id_transfer'  => 'required',
            'inputs.*.perkiraan'    => 'required',
            'inputs.*.akuntansi_to' => 'required',
            'inputs.*.total'        => 'required',
        ]);
        
        $totalSum = 0;
        $id_transfer = null;
    
        foreach ($request->inputs as $key => $value) {
            $perkiraan = MasterPerkiraan::findOrFail($value['perkiraan']);
        
            TransferMasukDetails::create([
                'id_transfer'  => $value['id_transfer'],
                'perkiraan'     => $perkiraan ? $perkiraan->perkiraan . '.' . $perkiraan->sub_perkiraan : null,
                'sub_perkiraan' => $perkiraan->sub_perkiraan,
                'akuntansi_to'  => $value['akuntansi_to'],
                'total'         => $value['total'],
                'created_by'    => Auth::user()->nama_user,
            ]);
    
            if ($value['akuntansi_to'] === 'D') {
                $totalSum += $value['total'];
            }

            if ($id_transfer === null) {
                $id_transfer = $value['id_transfer'];
            }
        }
            
        return redirect()->route('bg-masuk.index')->with('success','Data transfer baru berhasil ditambahkan!');
    }

    public function edit($id_transfer){

        $transfer   = TransferMasukHeader::where('id_transfer', $id_transfer)->first();
        $check      = KasMasukHeader::where('id_transfer', $id_transfer)->first();
        $kas_masuk  = KasMasukHeader::all();
        $outlet     = MasterOutlet::where('status', 'Y')->get();

        return view('bg-masuk.edit', compact('transfer', 'outlet', 'kas_masuk','check'));
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

        return redirect()->route('bg-masuk.index')->with('success', 'Transfer masuk baru berhasil ditambahkan kedalam kas masuk');
    }

    public function store_validasi($id_transfer)
    {

        TransferMasukHeader::where('id_transfer', $id_transfer)->update([
            'flag_kas_ar'        => 'Y',
            'updated_at'         => NOW(),
            'updated_by'         => Auth::user()->nama_user
        ]);

        return redirect()->route('bg-masuk.index')->with('success', 'Transfer masuk baru berhasil ditambahkan kedalam kas masuk');
    }

    public function delete($id)
    {
        $updated = MasterSales::where('id', $id)->update([
                'status'         => 'N',
                'updated_at'     => NOW(),
                'updated_by'     => Auth::user()->nama_user
            ]);

        if ($updated){
            return redirect()->route('bg-masuk.index')->with('success','Stok Gudang berhasil dihapus!');
        } else{
            return redirect()->route('bg-masuk.index')->with('danger','Stok Gudang gagal dihapus');
        }
        
    }

    
}
