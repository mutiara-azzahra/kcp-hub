@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Details Mutasi</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('mutasi-part.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                <a class="btn btn-warning btn-md m-1" href=""><i class="fas fa-check"></i> Approve</a>
                <a class="btn btn-danger btn-md m-1" href=""><i class="fas fa-ban"></i> Tolak</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            <div class="float-left">
                Details Mutasi
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">No. Mutasi</th>
                            <td>:</td>
                            <td class="text-left"><b></b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 p-1">
                    <table class="table table-hover table-bordered table-sm bg-light table-striped" >
                        <thead>
                            <tr style="background-color: #6082B6; color:white">
                                <th class="text-center">Part No</th>
                                <th class="text-center">Rak Asal</th>
                                <th class="text-center">Rak Tujuan</th>
                                <th class="text-center">Aksi</th>
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
                                    <a class="btn btn-info btn-sm" href="{{ route('sales-order.edit', $d->id) }}">
                                        <i class="fa fa-edit"></i>
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