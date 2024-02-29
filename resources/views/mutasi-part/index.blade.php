@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>List Mutasi</h4>
            </div>
            <div class="float-right m-1">
                <a class="btn btn-success m-1" href=""><i class="fas fa-plus"></i> Tambah Mutasi Manual</a>
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
        <div class="card-header">
            <b>List Mutasi</b>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">No. Mutasi</th>
                            <th class="text-center">Tgl. Buat</th>
                            <th class="text-center">Rak Asal</th>
                            <th class="text-center">Rak Tujuan</th>
                            <th class="text-center">Approval Head Gudang</th>
                            <th class="text-center">Tgl. Approve</th>
                            <th class="text-center">Tgl. Cetak SJ Mutasi</th>
                            <th class="text-center">Cetak SJ Mutasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($mutasi as $m)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $m->no_mutasi }}</td>
                            <td class="text-left">{{ Carbon\Carbon::parse($m->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $m->rak1->kode_rak_lokasi }}</td>
                            <td class="text-center">{{ $m->rak2->kode_rak_lokasi }}</td>

                            @if($m->approval_head_gudang == 'Y')
                            <td class="text-center">Diterima</td>

                            @elseif($m->approval_head_gudang == 'N')

                            <td class="text-center">Belum diterima</td>
                            @endif
                            <td class="text-center">{{ $m->tanggal_approval }}</td>
                            <td class="text-center">{{ $m->tanggal_cetak_sj_mutasi }}</td>

                            @if($m->cetak_sj_mutasi == 'Y')
                            <td class="text-center">Dicetak</td>

                            @elseif($m->cetak_sj_mutasi == 'N')
                            <td class="text-center">Belum dicetak</td>

                            @endif
                            <td class="text-center">
                                <!-- <a class="btn btn-warning btn-sm m-1" href="{{ route('mutasi-part.details', $m->no_mutasi) }}" data-toggle="tooltip" title="Cetak"><i class="fas fa-print"></i></a> -->
                                <a class="btn btn-primary btn-sm m-1" href="{{ route('mutasi-part.details', $m->no_mutasi) }}" data-toggle="tooltip" title="Details"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            <b>List Mutasi Diterima</b>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example3s">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal Buat</th>
                            <th class="text-center">No. Mutasi</th>
                            <th class="text-center">Rak Asal</th>
                            <th class="text-center">Rak Tujuan</th>
                            <th class="text-center">Approval Head Gudang</th>
                            <th class="text-center">Tgl. Cetak Mutasi</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($mutasi_approved as $m)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $m->no_mutasi }}</td>
                            <td class="text-left">{{ Carbon\Carbon::parse($m->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $m->rak1->kode_rak_lokasi }}</td>
                            <td class="text-center">{{ $m->rak2->kode_rak_lokasi }}</td>

                            @if($m->approval_head_gudang == 'Y')
                            <td class="text-center">Diterima</td>

                            @elseif($m->approval_head_gudang == 'N')

                            @endif
                            <td class="text-center">{{ $m->tanggal_cetak_sj_mutasi }}</td>
                            <td class="text-center"><a class="btn btn-info btn-sm" href="{{ route('mutasi-part.details', $m->no_mutasi) }}" data-toggle="tooltip" title="Details"><i class="fas fa-eye"></i></a></td>
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