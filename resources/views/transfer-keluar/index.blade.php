@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>Transfer Keluar</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success m-1" href="{{ route('transfer-keluar.create') }}"><i class="fas fa-plus"></i> Tambah Transfer Keluar</a>
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
                            <th class="text-center">No. Transfer</th>
                            <th class="text-center">Tgl. Bank</th>
                            <th class="text-center">Bank</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center">Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $no=1;
                    @endphp

                    @foreach($tf_keluar as $p)
                    <tr>
                        <td class="text-center">{{ $p->id_transfer }}</td>
                        <td class="text-center">{{ $p->tanggal_bank }}</td>
                        <td class="text-center">{{ $p->bank }}</td>
                        <td class="text-right">{{ number_format($p->details->where('akuntansi_to', 'D')->sum('total'), 0, ',', ',') }}</td>
                        <td class="text-left">{{ $p->keterangan }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href="{{ route('transfer-keluar.details', $p->id_transfer ) }}">
                                <i class="fas fa-edit"></i>
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

<script>
function printAndRefresh(url){
    window.open(url, '_blank');
    
    window.location.reload();
} 
</script>

@endsection