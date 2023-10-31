@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Reset Validasi Sales Order</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('validasi-so.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <div class="col-lg-12">
                        Mengembalikan ke Cetak SO
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
                                    <th class="text-center"></th>
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
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{{ route('validasi-so.cetak',$v->noso) }}"><i class="fas fa-refresh"></i></a>
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