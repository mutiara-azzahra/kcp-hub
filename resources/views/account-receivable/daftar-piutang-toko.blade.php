@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Daftar Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('account-receivable.index') }}"><i class="fas fa-plus"></i> Kembali</a>
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

    <form action="{{ route('account-receiveable.search')}}" method="POST">
        @csrf
        <div class="card" style="padding: 10px;">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="float-right pt-3">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Cari Toko</button>                            
                </div>
            </div>
        </div>
    </form>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Nominal Invoice</th>
                            <th class="text-center">Tanggal Invoice</th>
                            <th class="text-center">Tanggal Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($invoice as $s)
                        <tr>
                            <td class="text-left">{{ $s->noinv }}</td>
                            <td class="text-center">{{ $s->kd_outlet }}</td>
                            <td class="text-left">{{ $s->nm_outlet }}</td>
                            <td class="text-right">{{ number_format($s->details_invoice->sum('nominal_total'), 0, ',', ',') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($s->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center" style="background-color: yellow; color:black">{{ Carbon\Carbon::parse($s->tgl_jatuh_tempo)->format('d-m-Y') }}</td>
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