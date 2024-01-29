@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Master Kode Rak</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kode-rak-lokasi.create') }}"><i class="fas fa-plus"></i> Tambah Kode Rak</a>
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
                            <th class="text-center">Kode Rak</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($kode_rak as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $p->kode_rak_lokasi }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('kode-rak-lokasi.show',$p->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm" href="{{ route('kode-rak-lokasi.edit',$p->id) }}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm" href="{{ route('kode-rak-lokasi.delete',$p->id) }}"><i class="fas fa-times-circle"></i></a>
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