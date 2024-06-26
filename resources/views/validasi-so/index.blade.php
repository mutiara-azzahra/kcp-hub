@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Validasi SO</h4>
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
            <div class="col-lg-12">
                <div class="float-left">
                    Validasi Sales Order/SO
                </div>       
            </div>
            <div class="float-right">
                <a class="btn btn-warning" href="{{ route('validasi-so.reset') }}"><i class="fas fa-refresh"></i> Reset Validasi</a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Area SO</th>
                            <th class="text-center">No Sales Order</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Tgl. SO</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($validasi_so_gudang as $v)
                        <tr>
                            <td class="text-center">{{ $v->area_so }}</td>
                            <td class="text-left">{{ $v->noso }}</td>
                            <td class="text-center">{{ $v->kd_outlet }}</td>
                            <td class="text-left">{{ $v->nm_outlet }}</td>
                            <td class="text-center">{{ $v->crea_date }}</td>                                    
                            <td class="text-center">
                                <a class="btn btn-success btn-sm" href="{{ route('validasi-so.details',$v->noso) }}"><i class="fas fa-check"></i></a>
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
            <div class="col-lg-12">
                <div class="float-left">
                    SO Tervalidasi
                </div>       
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Area SO</th>
                            <th class="text-center">No Sales Order</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Tgl. SO</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($so_validated as $v)
                        <tr>
                            <td class="text-center">{{ $v->area_so }}</td>
                            <td class="text-left">{{ $v->noso }}</td>
                            <td class="text-center">{{ $v->kd_outlet }}</td>
                            <td class="text-left">{{ $v->nm_outlet }}</td>
                            <td class="text-center">{{ $v->crea_date }}</td>
                            
                            @if($v->flag_cetak_gudang == 'N')
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" href="{{ route('validasi-so.cetak',$v->noso) }}" target="_blank"><i class="fas fa-print"></i></a>
                                </td>
                            @else

                            @endif
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