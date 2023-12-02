@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Pembayaran Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-danger" href="{{ route('piutang-toko.create') }}"><i class="fas fa-plus"></i> Potong Titipan</a>
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
            List Pemotongan Belum Selesai
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Piutang</th>
                            <th class="text-center">Kode / Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Nominal Potong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($piutang_header as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $p->noinv }}</td>
                            <td class="text-center">{{ $p->kd_outlet }} / {{ $p->nm_outlet }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('piutang-toko.details', $p->no_piutang ) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Kas Masuk</th>
                            <th class="text-center">Kode / Nama Toko</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Tgl. BG</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection