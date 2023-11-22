@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Report LSS</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('report-lss.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h5>{{ \Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}</h5>
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
                <table class="table table-hover table-bordered table-sm bg-light">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Sub. Kel. Part</th>
                            <th class="text-center">Produk Part</th>
                            <th class="text-center">Awal Amount</th>
                            <th class="text-center">Beli</th>
                            <th class="text-center">Jual RBP</th>
                            <th class="text-center">Jual DBP</th>
                            <th class="text-center">Akhir Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $p)
                        <tr>
                            <td class="text-left">{{ $p->sub_kelompok_part }}</td>
                            <td class="text-left">{{ $p->produk_part }}</td>
                            <td class="text-right">{{ number_format($p->awal_amount, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($p->beli, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($p->jual_rbp, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($p->jual_dbp, 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format($p->akhir_amount, 0, ',', '.') }}</td>
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