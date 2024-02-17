@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Daftar Piutang Toko</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('account-receivable.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                @foreach($invoice_selected as $i)
                        
                <form action="{{ route('account-receivable.cetak-pdf', ['noinv' => $i->noinv]) }}" method="POST">
                @csrf
                
                @endforeach

                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th></th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Kode Toko</th>
                            <th class="text-center">Nama Toko</th>
                            <th class="text-center">Nominal Invoice</th>
                            <th class="text-center">Tanggal Invoice</th>
                            <th class="text-center">Tanggal Jatuh Tempo</th>
                        </tr>
                    </thead>
                    <tbody class="input-fields">

                        @php
                        $no=1;
                        @endphp
                        
                        @foreach($invoice_selected as $s)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="selected_items[]" value="{{ $s->noinv }}" checked>
                                </div>
                            </td>
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

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="float-left">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-print"></i> Cetak Daftar Piutang PDF</button>                            
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection