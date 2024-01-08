@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>List Nota Barang Masuk</h4>
            </div>
            <div class="float-right m-1">
                <a class="btn btn-success m-1" href="{{ route('stok-gudang.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">Invoice No</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Tanggal Nota</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($list_barang_masuk as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->invoice_non }}</td>
                            <td class="text-center">{{ $p->supplier }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($p->created_at )->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('stok-gudang.list-details',$p->id) }}"><i class="fas fa-eye"></i></a>
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