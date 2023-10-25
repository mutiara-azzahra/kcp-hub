@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Approval SP</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('surat-jalan.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-header">
                    <div class="float-left">
                        Sales Order
                    </div>
                    <div class="float-right">

                        @foreach($surat_pesanan_id as $s)

                            @if(isset($s->so))

                            @else
                                <a class="btn btn-warning btn-md m-1" href="{{ route('surat-jalan.approve', $s->nosp) }}"><i class="fas fa-reply"></i> Approve</a>
                                <a class="btn btn-danger btn-md m-1" href="{{ route('surat-jalan.reject', $s->nosp) }}"><i class="fas fa-ban"></i>Tolak</a>
                            @endif

                        @endforeach
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 p-1">
                            <table class="table table-hover bg-light table-striped">
                                <tr>
                                    <th class="text-left">No. Surat Pesanan / SP</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $nosp }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Kode / Nama Toko</th>
                                    <td>:</td>
                                    @foreach($surat_pesanan_id as $s)
                                        <td class="text-left">{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="text-left">Plafond Toko</th>
                                    <td>:</td>
                                    <td class="text-left"></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Piutang Terakhir</th>
                                    <td>:</td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href=""><i class="fas fa-eye"></i> Piutang Terakhir</a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-12 p-1">
                                <table class="table table-hover table-sm bg-light table-striped" >
                                    <thead>
                                        <tr>
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">HET</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Disc (%)</th>
                                            <th class="text-center">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($surat_pesanan_id as $s)
                                            @foreach($s->details_sp as $d)
                                                <tr>
                                                    <td class="text-left">{{ $d->part_no }}</td>
                                                    <td class="text-center">{{ $d->hrg_pcs }}</td>
                                                    <td class="text-center">{{ $d->qty }}</td>
                                                    <td class="text-center">{{ $d->nominal_disc }}</td>
                                                    <td class="text-center">{{ $d->nominal_total }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection