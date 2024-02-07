@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Master Perkiraan</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('master-perkiraan.create') }}"><i class="fas fa-plus"></i> Tambah Perkiraan</a>
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
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No</th>
                            <th class="text-center">Part Nomor</th>
                            <th class="text-center">Part Nama</th>
                                @if(in_array(Auth::user()->id_role, [10]))
                                @else
                                <th class="text-center">HET</th>
                                @endif
                            <th class="text-center">Kode Produk</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($master_part as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}.</td>
                            <td class="text-left">{{ $p->part_no }}</td>
                            <td class="text-left">{{ $p->part_nama }}</td>
                                @if(in_array(Auth::user()->id_role, [10]))
                                @else
                                <td class="text-right">{{ number_format($p->het, 0, ',', ',') }}</td>
                                @endif
                            <td class="text-center">{{ $p->kode_produk }}</td>
                            <td class="text-center"> 
                                <form action="{{ route('master-part.delete', $p->id) }}" method="POST" id="form_delete_{{ $p->id }}" data-id="{{ $p->id }}">                                       
                                    <a class="btn btn-info btn-sm" href="{{ route('master-part.edit',$p->id) }}"><i class="fas fa-edit"></i></a>
                                    
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