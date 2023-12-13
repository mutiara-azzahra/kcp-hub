@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>BG Masuk</h4>
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
            BG Gantung
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. BG</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Nominal BG</th>
                            <th class="text-center">Tgl. Masuk BG</th>
                            <th class="text-center">Tgl. Jatuh Tempo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $no=1;
                    @endphp

                    @foreach($bg_gantung as $p)
                    <tr>
                        <td class="text-left">{{ $p->no_bg }}/{{$p->bank}}</td>
                        <td class="text-center">{{ $p->kd_outlet }}</td>
                        <td class="text-left">{{ $p->outlet->nm_outlet }}</td>
                        <td class="text-right">{{ number_format($p->nominal, 0, ',', ',') }}</td>
                        <td class="text-center">{{ $p->tanggal_rincian_tagihan }}</td>
                        <td class="text-center">{{ $p->jatuh_tempo_bg }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href=""><i class="fas fa-check-box"></i></a>
                            <a class="btn btn-warning btn-sm" href=""><i class="fas fa-random"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="card" style="padding: 10px;">
        <div class="card-header">
            BG Cair
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">ID. BG</th>
                            <th class="text-center">Tgl. Cair</th>
                            <th class="text-center">Tgl. Balik</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Nominal</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $no=1;
                    @endphp

                    @foreach($bg_gantung as $p)
                    <tr>
                        <td class="text-center">{{ $p->no_bg }}/{{$p->bank}}</td>
                        <td class="text-center">{{ $p->tanggal_bank }}</td>
                        <td class="text-center">{{ $p->tanggal_rincian_tagihan }}</td>
                        <td class="text-right">{{ number_format($p->nominal, 0, ',', ',') }}</td>
                        <td class="text-left">{{ $p->keterangan }}</td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" href="">
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