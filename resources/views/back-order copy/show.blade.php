@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Back Order Details</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('back-order.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
            <div class="float-left">
                Back Order Toko
            </div>
            <div class="float-right">
                <form action="{{ route('back-order.store', ['id' => $back_order->id ]) }}" method="POST" id="form_forward_{{ $back_order->id }}" data-id="{{ $back_order->id }}">

                    @csrf
                    @method('GET')
                    
                    <a class="btn btn-warning btn-sm" onclick="Teruskan('{{$back_order->id}}')"><i class="fas fa-plus"></i> Teruskan Menjadi SO</a>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">No. Back Order / BO</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $back_order->nobo }}</b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode / Nama Toko</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $back_order->kd_outlet }} / {{ $back_order->nm_outlet }}</b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 p-1">
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" >
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Harga/Pcs</th>
                                    <th class="text-center">Qty BO</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Disc (%)</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($back_order->details as $d)
                                <tr>
                                    <td class="text-left">{{ $d->part_no }}</td>
                                    <td class="text-right">{{ number_format($d->hrg_pcs, 0, ',', ',') }}</td>
                                    <td class="text-center">{{ $d->qty }}</td>
                                    <td class="text-center" style="background-color: yellow; color:black">{{ $d->stok_ready->stok }}</td>
                                    <td class="text-center">{{ $d->disc }} %</td>
                                    <td class="text-center">
                                        <form action="{{ route('back-order.delete', $d->id) }}" method="POST" id="form_delete_{{ $d->id }}" data-id="{{ $d->id }}">
                                            @csrf
                                            @method('DELETE')
                                        
                                            <a class="btn btn-danger btn-sm" onclick="Hapus('{{ $d->id }}')"><i class="fas fa-times"></i></a>
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

</div>
@endsection

@section('script')

<script>
    Teruskan = (id)=>{
        Swal.fire({
            title: 'Apakah anda yakin meneruskan BO menjadi SO?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'Teruskan' ,
            cancelButtonText: 'Batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('form_forward_' + id).submit();
                }
        })
    }


    Hapus = (id)=>{
        Swal.fire({
            title: 'Apakah anda yakin mengahpus detail BO ini?',
            text:  "Data tidak dapat kembali" ,
            showCancelButton: true,
            confirmButtonColor: '#3085d6' ,
            cancelButtonColor: 'red' ,
            confirmButtonText: 'Teruskan' ,
            cancelButtonText: 'Batal' ,
            reverseButtons: false
            }).then((result) => {
                if (result.value) {
                    document.getElementById('form_delete_' + id).submit();
                }
        })
    }

    
</script>

@endsection