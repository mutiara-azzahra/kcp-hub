@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Retur</h4>
            </div>
            <div class="float-right m-1">
                 <a class="btn btn-success m-1" href="{{ route('retur.create') }}"><i class="fas fa-plus"></i> Tambah Retur</a>
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
            Retur Toko
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Retur</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($retur as $p)
                        <tr>
                            <td class="text-center">{{ $p->no_retur }}</td>
                            <td class="text-center">{{ $p->noinv }}</td>
                            <td class="text-left">{{ $p->kd_toko }}</td>
                            <td class="text-left">{{ $p->nm_toko }}</td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-sm" href=""><i class="fas fa-eye"></i>
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