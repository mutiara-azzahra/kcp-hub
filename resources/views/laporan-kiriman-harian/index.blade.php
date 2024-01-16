@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Laporan Kiriman Harian</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-warning" href="{{ route('laporan-kiriman-harian.history') }}"><i class="fas fa-refresh"></i> Histori LKH</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>  
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            <div class="col-lg-12">
                List Sales Order yang Belum LKH
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">
                @foreach($packingsheet as $s)
                        
                <form action="{{ route('laporan-kiriman-harian.store', ['nops' => $s->nops]) }}" method="POST">
                @csrf
                
                @endforeach

                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center"></th>
                            <th class="text-center">Kode/Nama Toko</th>
                            <th class="text-center">No. Packingsheet</th>
                            <th class="text-center">Tgl. Packingsheet</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">No. Surat Jalan</th>
                            <th class="text-center">Tanggal Surat Jalan</th>
                            <th class="text-center">Jenis Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($packingsheet as $s)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->nops }}">
                                </div>
                            </td>
                            <td class="text-center">{{ $s->nm_outlet }}</td>
                            <td class="text-center">{{ $s->nops }}</td>
                            <td class="text-center">{{ $s->created_at }}</td>

                            
                            <td class="text-left">
                                @foreach ($s->details_ps->pluck('invoice.noinv')->unique() as $x)
                                {{ $x }},
                                @endforeach
                            </td>

                            @foreach( $s->details_sj as $j)
                            <td class="text-center">{{ $j->nosj }}</td>
                            <td class="text-center">{{ $j->created_at }}</td>

                            @endforeach
                            <td class="text-center"></td>

                        </tr>
                            @endforeach
                    </tbody>
                </table>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <div class="float-left">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                            
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-header">
            <div class="col-lg-12">
                List LKH Siap Kirim
            </div>
        </div>
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Jam Berangkat</th>
                            <th class="text-center">Jam Kembali</th>
                            <th class="text-center">No. LKH</th>
                            <th class="text-center">Driver</th>
                            <th class="text-center">Helper</th>
                            <th class="text-center">Plat Mobil </th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($lkh as $s)
                        <tr>
                            <td class="text-center">{{ $s->jam_berangkat }}</td>
                            <td class="text-center">{{ $s->jam_kembali }}</td>
                            <td class="text-center">{{ $s->no_lkh }}</td>
                            <td class="text-center">{{ $s->driver }}</td>
                            <td class="text-center">{{ $s->helper }}</td>
                            <td class="text-center">{{ $s->plat_mobil }}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('laporan-kiriman-harian.details',$s->no_lkh) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" onClick="printAndRefresh('{{ route('laporan-kiriman-harian.cetak', $s->no_lkh) }}')" target="_blank">
                                    <i class="fas fa-print"></i>
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