@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Kiriman Harian</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('laporan-kiriman-harian.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>  
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            <div class="col-lg-12">
                List LKH Selesai
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Jam Berangkat</th>
                            <th class="text-center">Jam Kembali</th>
                            <th class="text-center">No. LKH</th>
                            <th class="text-center">Driver</th>
                            <th class="text-center">Helper</th>
                            <th class="text-center">Plat Mobil </th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($history as $s)
                        <tr>
                            <td class="text-center">{{ $s->jam_berangkat }}</td>
                            <td class="text-center">{{ $s->jam_kembali }}</td>
                            <td class="text-center">{{ $s->no_lkh }}</td>
                            <td class="text-center">{{ $s->driver }}</td>
                            <td class="text-center">{{ $s->helper }}</td>
                            <td class="text-center">{{ $s->plat_mobil }}</td>
                            <td class="text-center">
                                <a class="btn btn-warning btn-sm" href="{{ route('laporan-kiriman-harian.cetak', $s->no_lkh) }}" target="_blank">
                                    <i class="fas fa-print"></i>
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