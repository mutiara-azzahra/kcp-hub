@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
                <div class="col-lg-12 pb-3">
                        <div class="float-right m-1">
                            <a class="btn btn-success" href="{{ route('validasi-so.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>

                        @php
                            $isValidasiButtonShown = false;
                        @endphp

                        @foreach($validasi_id->details_so as $s)
                            @if($s->stok_ready->stok >= $s->qty && !$isValidasiButtonShown)
                                <div class="float-right m-1">
                                    <a class="btn btn-warning" href="{{ route('validasi-so.validasi', $so->noso) }}"><i class="fas fa-check"></i> Validasi</a>
                                </div>
                                @php
                                    $isValidasiButtonShown = true;
                                @endphp
                            @endif
                        @endforeach
                    </div>
                </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" id="myAlert">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card" style="padding: 10px;">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 p-1">
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-left">No. Sales Order/SO</th>
                                    <td>:</td>
                                    <td class="text-left"><b>{{ $so->noso }}</b></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Kode / Nama Toko</th>
                                    <td>:</td>
                                    <td class="text-left"><b>{{ $so->kd_outlet }} / {{ $so->nm_outlet }}</b></td>
                                </tr>
                            </table>
                        </div>
                            <div class="col-lg-12 p-1">
                                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Nama Part</th>
                                            <th class="text-center">Qty SO</th>
                                            <th class="text-center">Stok Gudang</th>
                                            <th class="text-center">Diskon</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Ubah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp

                                            @foreach($validasi_id->details_so as $s)
                                            <tr>
                                                <td class="text-left">{{ $s->part_no }}</td>
                                                <td class="text-left">{{ $s->nama_part->part_nama }}</td>
                                                <td class="text-right">{{ $s->qty }}</td>
                                                <td class="text-right">{{ $s->stok_ready->stok }}</td>
                                                <td class="text-center">{{ $s->disc }}%</td>

                                                @if( $s->flag_vald_gudang == null)
                                                <td class="text-center" style="background-color: yellow;">
                                                    Belum Divalidasi
                                                </td>
                                                
                                                @else
                                                <td class="text-center" style="background-color: lime;">
                                                    Tervalidasi
                                                </td>
                                                @endif

                                                <td class="text-center">
                                                    <a class="btn btn-info btn-sm" href="{{ route('validasi-so.edit_details', $s->id) }}"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
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