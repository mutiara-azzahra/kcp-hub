@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kas-masuk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
        <div class="col-lg-8 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">Tgl. Transaksi</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $kas_masuk->tanggal_rincian_tagihan }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">No. Kas Masuk</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $kas_masuk->no_kas_masuk }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Terima Dari</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $kas_masuk->terima_dari }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Keterangan</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $kas_masuk->keterangan }}</b></td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection