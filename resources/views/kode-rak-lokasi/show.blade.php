@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Kode Rak Lokasi</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('kode-rak-lokasi.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Kode Rak Lokasi</strong><br>
                            {{ $kode_rak->kode_rak_lokasi }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">Part No</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Mutasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($rak_gudang as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->part_no }}</td>
                            <td class="text-right">{{ $p->stok }}</td> 
                            <td class="text-center">
                                <a class="btn btn-warning btn-sm" href="{{ route('kode-rak-lokasi.mutasi',$p->id) }}">
                                    <i class="nav-icon fas fa-share" data-toggle="tooltip" title="Mutasi"></i>
                                </a>
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


@endsection