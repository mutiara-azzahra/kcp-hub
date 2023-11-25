@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details Kas Keluar</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kas-keluar.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <td class="text-left"><b>{{ Carbon\Carbon::parse($kas_keluar->tanggal_transaksi)->format('d-m-Y') }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">No. Kas Keluar</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->no_keluar }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Pembayaran</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->pembayaran }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Keterangan</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_keluar->keterangan }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12 p-1" id="main" data-loading="true">
                <form action="{{ route('kas-masuk.store-details')}}" method="POST">
                    @csrf
                    <div class="table-container">
                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Perkiraan</th>
                                    <th class="text-center">Akuntansi To</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                @foreach($kas_keluar->details_keluar as $i)
                                <tr>
                                    <td class="text-left">
                                        {{ $i }} - {{ $i->perkiraan }}
                                    </td>
                                    <td class="text-center">
                                        @if($i->akuntansi_to == 'D')

                                        DEBET
                                        @else

                                        KREDIT
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        {{ number_format($i->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection