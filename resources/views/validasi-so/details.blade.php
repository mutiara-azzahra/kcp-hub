@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-header">
                    <div class="col-lg-12 pb-3">
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('validasi-so.validasi', $so->noso) }}"><i class="fas fa-check"></i> Validasi</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 p-1">
                            <table class="table table-hover bg-light table-striped">
                                <tr>
                                    <th class="text-left">No. Sales Order/SO</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $so->noso }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Kode / Nama Toko</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $so->kd_outlet }} / {{ $so->nm_outlet }}</td>
                                </tr>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">
                                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Nama Part</th>
                                            <th class="text-center">Qty SO</th>
                                            <th class="text-center">Stock Gudang</th>
                                            <th class="text-center">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp

                                        @foreach($validasi_id as $d)
                                            @foreach($d->details_so as $s)
                                            <tr>
                                                <td class="text-left">{{ $s->part_no }}</td>
                                                <td class="text-left">{{ $s->nama_part->part_nama }}</td>
                                                <td class="text-center">{{ $s->qty }}</td>
                                                <td class="text-center">{{ $s->stok_ready }}</td>
                                                <td class="text-center" style="background-color: lime;">
                                               
                                                </td>
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