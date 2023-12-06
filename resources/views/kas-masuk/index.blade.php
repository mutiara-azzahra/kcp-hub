@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>Kas Masuk</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success m-1" href="{{ route('kas-masuk.bukti-bayar') }}"><i class="fas fa-plus"></i> Bukti Terima Pembayaran</a>
                <a class="btn btn-info m-1" href="{{ route('kas-masuk.bayar-manual') }}"><i class="fas fa-plus"></i> Terima Pembayaran Manual</a>
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
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">No. Kas Masuk</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $no=1;
                    @endphp

                    @foreach($belum_selesai as $p)
                    <tr>
                        <td class="text-center">{{ $no++ }}.</td>
                        <td class="text-left">{{ $p->no_kas_masuk }}</td>
                        <td class="text-left">{{ $p->kd_outlet }}</td>
                        <td class="text-left">{{ $p->outlet->nm_outlet }}</td>
                        <td class="text-center">{{ $p->pembayaran_via }}</td>
                        <td class="text-right">Rp. {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td>
                        <a class="btn btn-warning btn-sm" onClick="printAndRefresh('{{ route('kas-masuk.cetak-tanda-terima', $p->no_kas_masuk) }}')" href="{{ route('kas-masuk.cetak', $p->no_kas_masuk) }}" target="_blank"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example3">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Kas Masuk</th>
                            <th class="text-center">Tgl. Kas Masuk</th>
                            <th class="text-center">Potong Faktur</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Terima Dari</th>
                            <th class="text-center">Nominal</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($selesai as $p)
                    <tr>
                        <td class="text-left">{{ $p->no_kas_masuk }}</td>
                        <td class="text-center">{{ Carbon\Carbon::parse($p->tanggal_rincian_tagihan)->format('d-m-Y') }}</td>
                        <td class="text-left">{{ $p->keterangan }}</td>
                        <td class="text-center">{{ $p->pembayaran_via }}</td>
                        <td class="text-right">Rp. {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href="{{ route('kas-masuk.cetak', $p->no_kas_masuk) }}" target="_blank"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-warning btn-sm" href="{{ route('kas-masuk.cetak', $p->no_kas_masuk) }}" target="_blank"><i class="fas fa-print"></i></a>
                            <a class="btn btn-danger btn-sm" href="{{ route('kas-masuk.cetak', $p->no_kas_masuk) }}" target="_blank"><i class="fas fa-times"></i></a>
                        </td>
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

<script>
function printAndRefresh(url){
    window.open(url, '_blank');
    
    window.location.reload();
} 
</script>

@endsection