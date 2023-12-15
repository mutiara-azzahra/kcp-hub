@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Report LSS</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('export-pajak.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="col-lg-12 pb-3">
            <div class="float-left">
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 2px;">
        <div class="card-body p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">OF</th>
                            <th class="text-center">KODE_OBJEK</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">HARGA_SATUAN</th>
                            <th class="text-center">JUMLAH_BARANG</th>
                            <th class="text-center">HARGA_TOTAL</th>
                            <th class="text-center">DISKON</th>
                            <th class="text-center">DPP</th>
                            <th class="text-center">PPN</th>
                            <th class="text-center">TARIF_PPNBM</th>
                            <th class="text-center">PPNBM</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>


                    
                    @foreach($details as $p)
                        <tr>
                            <td class="text-left">OF</td>
                            <td class="text-left">{{ $p->part_no }}</td>
                            <td class="text-left">{{ $p->nama_part->nm_part }}</td>
                            <td class="text-left">{{ $p->hrg_pcs }}</td>
                            <td class="text-left">{{ $p->qty }}</td>

                            <td class="text-right">{{ number_format(($p->nominal_total), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($p->nominal_disc), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format( ($p->nominal_total/1.11 ), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($p->nominal_total * 0.11), 0, ',', '.') }}</td>
                            <td class="text-right">0</td>
                            <td class="text-left">0</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


@endsection