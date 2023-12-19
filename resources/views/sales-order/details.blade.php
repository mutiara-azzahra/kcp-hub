@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Approval SP / Surat Pesanan</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('sales-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                @if(Auth::user()->id_role == 24)
                    @foreach($surat_pesanan_id as $s)

                        @if(isset($s->so))

                        @else
                            <a class="btn btn-warning btn-md m-1" href="{{ route('sales-order.approve', $s->nosp) }}"><i class="fas fa-check"></i> Approve</a>
                            <a class="btn btn-danger btn-md m-1" href="{{ route('sales-order.reject', $s->nosp) }}"><i class="fas fa-ban"></i> Tolak</a>
                        @endif

                    @endforeach
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">No. Surat Pesanan / SP</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $nosp }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode / Nama Toko</th>
                            <td>:</td>
                            @foreach($surat_pesanan_id as $s)
                                <td class="text-left"><b>{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</b></td>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="text-left">Plafond Toko</th>
                            <td>:</td>
                            @if($s->outlet->plafond != null)
                            <td class="text-left">Rp. {{ number_format($s->outlet->plafond->nominal_plafond, 0, ',', '.') }}</td>
                            @else
                            <td class="text-left" style="color: red;">Belum Ada Plafond</td>
                            @endif
                        </tr>
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
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" >
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">HET</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Disc (%)</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surat_pesanan_id as $s)
                                    @foreach($s->details_sp as $d)
                                        <tr>
                                            <td class="text-left">{{ $d->part_no }}</td>
                                            <td class="text-right">Rp. {{ number_format($d->hrg_pcs, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $d->qty }}</td>
                                            <td class="text-center">{{ $d->disc }} %</td>
                                            <td class="text-right">Rp. {{ number_format($d->nominal_total, 0, ',', '.') }}</td>
                                            @if(Auth::user()->id_role == 11)
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm" href="{{ route('sales-order.edit', $d->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td class="text-center" colspan="4"><b>TOTAL</b></td>
                                    <td class="text-right"><b>Rp. {{ number_format($totalSum, 0, ',', '.') }}</b></td>
                                </tr>
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