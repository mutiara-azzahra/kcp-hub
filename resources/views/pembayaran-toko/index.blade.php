@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Penerimaan Piutang Toko</h4>
            </div>
            <div class="float-right">
                <!-- <a class="btn btn-danger" href=""><i class="fas fa-plus"></i> Potong Titipan</a> -->
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
            Penerimaan Piutang Toko
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Pembayaran</th>
                            <th class="text-center">Tgl. Pemotongan</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Bank</th>
                            <th class="text-center">No. BG</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Tgl. Cetak</th>
                            <th class="text-center">Reff.</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        <tr>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                            <td class="text-left"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            List Pemotongan Belum Selesai
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example3">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No.</th>
                            <th class="text-center">No. Piutang</th>
                            <th class="text-center">Kode / Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Nominal Potong</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($piutang_header as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->no_piutang }}</td>
                            <td class="text-left">{{ $p->kd_outlet }} / {{ $p->nm_outlet }}</td>

                            @if($p->kas_masuk != null)
                            <td class="text-center">{{ $p->kas_masuk->pembayaran_via }}</td>
                            @else
                            <td></td>
                            @endif

                            <td class="text-right">{{ number_format($p->nominal_potong, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('piutang-toko.details', $p->no_piutang ) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('piutang-toko.edit', $p->no_piutang ) }}">
                                    <i class="fas fa-edit"></i>
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