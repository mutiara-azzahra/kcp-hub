@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Target SPV</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('master-target-spv-produk.create') }}"><i class="fas fa-plus"></i> Tambah Achievement SPV</a>
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
                            <th class="text-center">SPV</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Nominal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($target as $p)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-left">{{ $p->spv }}</td>
                            <td class="text-center">{{ $p->bulan }}</td>
                            <td class="text-center">{{ $p->id }}</td>
                            <td class="text-right">Rp. {{ number_format($p->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <form action="{{ route('master-target-spv-produk.delete', $p->id) }}" method="POST" id="form_delete">

                                    @csrf
                                    @method('DELETE')
                                    
                                    <a class="btn btn-danger btn-sm" onclick="Hapus('{{$p->id}}')"><i class="fas fa-times"></i></a>
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
            text:  "menghapus notifikasi" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'hapus data' ,
            cancelButtonText: 'batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    $('#form_delete').submit();
                }

        })
    }
</script>


@endsection