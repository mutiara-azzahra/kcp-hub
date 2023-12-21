@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Back Order Details</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('back-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                Back Order Toko
            </div>
            <div class="float-right">
                <a class="btn btn-success btn-md m-1" href="{{ route('back-order.store', $s->nobo) }}"><i class="fas fa-plus"></i> Teruskan Menjadi BO</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">No. Back Order / BO</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $nobo }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode / Nama Toko</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $s->kd_outlet }} / {{ $s->nm_outlet }}</b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 p-1">
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" >
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Nama Part</th>
                                    <th class="text-center">Qty BO</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Disc (%)</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">{{ $d->part_no }}</td>
                                    <td class="text-right">Rp. {{ number_format($d->hrg_pcs, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $d->qty }}</td>
                                    <td class="text-center">{{ $d->disc }} %</td>
                                    <td class="text-right">Rp. {{ number_format($d->nominal_total, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm" href="">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
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