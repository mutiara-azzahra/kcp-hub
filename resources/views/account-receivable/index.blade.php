@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Account Receiveable</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success m-1" href="{{ route('account-receivable.create') }}"><i class="fas fa-plus"></i> Tambah Piutang</a>
                <a class="btn btn-warning m-1" href="{{ route('account-receivable.cetak') }}"><i class="fas fa-print"></i> Cetak Tagihan Toko</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Nominal Invoice</th>
                            <th class="text-center">Tanggal Invoice</th>
                            <th class="text-center">Tanggal Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($invoice as $s)
                        <tr>
                            <td class="text-left">{{ $s->noinv }}</td>
                            <td class="text-center">{{ $s->kd_outlet }}</td>
                            <td class="text-left">{{ $s->nm_outlet }}</td>
                            <td class="text-right">{{ number_format($s->details_invoice->sum('nominal_total'), 0, ',', ',') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($s->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center" style="background-color: yellow; color:black">{{ Carbon\Carbon::parse($s->tgl_jatuh_tempo)->format('d-m-Y') }}</td>
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