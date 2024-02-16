@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Terima Rincian Tagihan</h4>
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
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Tanggal Buat</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Sales</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($ar_belum_diterima as $i)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::parse($i->tanggal_buat)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ $i->kd_outlet }}</td>
                            <td class="text-left">{{ $i->outlet->nm_outlet }}</td>
                            <td class="text-left">{{ $i->keterangan }}</td>
                            <td class="text-left">{{ $i->header_invoice->user_sales }}</td>
                            <td class="text-center">
                                <form action="{{ route('rincian-tagihan.approve', $i->id) }}" method="POST" id="form_terima_{{ $i->id }}" data-id="{{ $i->id }}">
                                    @csrf
                                    @method('POST')

                                    <a class="btn btn-success btn-sm" onclick="Terima('{{ $i->id }}')" data-toggle="tooltip" title="Terima"><i class="fas fa-check"></i></a>
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

    Terima = (id)=>{
        Swal.fire({
            title: 'Apa anda yakin menerima rincian tagihan ini?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'Terima tagihan' ,
            cancelButtonText: 'Batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('form_terima_' + id).submit();
                }
        })
    }

</script>

@endsection