@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Target Sales</h4>
            </div>
            <div class="float-right">
                <a class="btn m-1 btn-success" href="{{ route('master-target-sales-produk.index') }}"><i class="fas fa-plus"></i> Ach. Produk</a>
                <a class="btn m-1 btn-primary" href="{{ route('master-target.create') }}"><i class="fas fa-plus"></i> Tambah Achievement</a>
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
                            <th class="text-center">Sales</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($target as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->sales }}</td>
                            <td class="text-center">{{ $p->bulan }}</td>
                            <td class="text-center">{{ $p->tahun }}</td>
                            <td class="text-right">{{ number_format($p->nominal, 0, ',', ',') }}</td>
                            <td>
                            <form action="{{ route('master-target.delete', $p->id) }}" method="POST" id="form_delete_{{ $p->id }}" data-id="{{ $p->id }}">
                                    <a class="btn btn-info btn-sm" href="{{ route('master-target.edit',$p->id) }}"><i class="fas fa-edit"></i></a>

                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-danger btn-sm" onclick="Hapus('{{ $p->id }}')"><i class="fas fa-times"></i></a>
                                </form>

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

<script>
    Hapus = (id)=>{
        Swal.fire({
            title: 'Apa anda yakin menghapus data ini?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'hapus data' ,
            cancelButtonText: 'batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('form_delete_' + id).submit();
                }
        })
    }

</script>

@endsection