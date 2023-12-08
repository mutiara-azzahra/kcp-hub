@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>List Pembayaran Non AOP</h4>
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
                            <th class="text-center"></th>
                            <th class="text-center">Invoice</th>
                            <th class="text-center">Tgl. Nota</th>
                            <th class="text-center">Tgl. Jatuh Tempo</th>
                            <th class="text-center">Customer To</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($list_belum_bayar as $p)
                        <tr>
                            <td class="text-center">
                                <a class="btn btn-success btn-sm" href="{{ route('pembayaran-non-aop.pembayaran-nota',$p->invoice_non) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-info btn-sm" href="{{ route('pembayaran-non-aop.pembayaran',$p->invoice_non) }}"><i class="fa fa-plus"></i></a>
                            </td>
                            
                            <td class="text-left">{{ $p->invoice_non }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($p->tanggal_nota)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($p->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                            <td class="text-left">{{ $p->customer_to }}</td>
                            <td class="text-left">{{ $p->supplier }}</td>
                            <td class="text-right">{{ number_format($p->details_pembelian->sum('total_amount'), 0, ',', ',') }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-12">  
                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example1">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Tgl. Jatuh Tempo</th>
                            <th class="text-center">Invoice Non</th>
                            <th class="text-center">Customer To</th>
                            <th class="text-center">Supplier</th>
                            <th class="text-center">Amt. Nota</th>
                            <th class="text-center">Pembayaran Via</th>
                            <th class="text-center">Trx. From</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp

                        @foreach($list_sudah_bayar as $s)
                        <tr>
                            <td class="text-center">{{ Carbon\Carbon::parse($s->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                            <td class="text-left">{{ $s->invoice_non }}</td>
                            <td class="text-left">{{ $s->customer_to }}</td>
                            <td class="text-left">{{ $s->supplier }}</td>
                            <td class="text-right">{{ number_format($s->details_nota->sum('amount_nota'), 2, '.', ',') }}</td>
                            <td class="text-left">{{ $s->flag_pembayaran_via }}</td>
                            <td class="text-left">{{ $s->trx_from }}</td>
                            <td class="text-left">
                                <a class="btn btn-warning btn-sm" href="{{ route('pembayaran-non-aop.cetak', $s->invoice_non) }}" target="_blank"><i class="fas fa-print"></i></a>
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

@endsection