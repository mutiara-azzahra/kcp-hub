@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
            <div class="float-left">
                <h4>Report LSS</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('export-pajak.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="col-lg-12 pb-3">
            <div class="float-left">
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-danger" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    
    <div class="card" style="padding: 2px;">
        <div class="card-body p-2">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Toko</th>
                            <th class="text-center">Sales</th>
                            <th class="text-center">Tgl. Jatuh Tempo</th>
                            <th class="text-center">Tgl. Buat</th>
                            <th class="text-center">Amount Dpp</th>
                            <th class="text-center">Amount Disc</th>
                            <th class="text-center">Amount Dpp. Disc</th>
                            <th class="text-center">Amount PPn. Disc</th>
                            <th class="text-center">Amount Total</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>


                    
                    @foreach($invoice as $p)
                        <tr>
                            <td class="text-left">{{ $p->noinv }}</td>
                            <td class="text-left">{{ $p->nm_outlet }}</td>
                            <td class="text-left">{{ $p->user_sales }}</td>
                            <td class="text-left">{{ $p->tgl_jatuh_tempo }}</td>
                            <td class="text-left">{{ $p->created_at }}</td>

                            <td class="text-right">{{ number_format(($p->details_invoice->sum('nominal_total')/1.11), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($p->details_invoice->sum('nominal_disc')/1.11), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format( ($p->details_invoice->sum('nominal_total')-($p->details_invoice->sum('nominal_disc'))/1.11 ), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($p->details_invoice->sum('nominal_disc') * 0.11), 0, ',', '.') }}</td>
                            <td class="text-right">{{ number_format(($p->details_invoice->sum('nominal_total')/1.11), 0, ',', '.') }}</td>
                            <td class="text-left">{{ $no_faktur_pajak++ }}</td>
                            
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