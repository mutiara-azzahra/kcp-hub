@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>List Pembayaran Non AOP</b></h4>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
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
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href="{{ route('pembayaran-non-aop.pembayaran',$p->invoice_non) }}"><i class="fa fa-plus"></i>
                                        </a>
                                    </td>
                                    <td class="text-left">{{ $p->invoice_non }}</td>
                                    <td class="text-left">{{ $p->tanggal_nota }}</td>
                                    <td class="text-left">{{ $p->tanggal_jatuh_tempo }}</td>
                                    <td class="text-left">{{ $p->customer_to }}</td>
                                    <td class="text-left">{{ $p->supplier }}</td>
                                    <td class="text-left">Rp. {{ number_format($p->details_pembelian->sum('total_amount'), 0, ',', '.') }}</td>

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
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Tgl. Jatuh Tempo</th>
                                    <th class="text-center">Group Pembayaran</th>
                                    <th class="text-center">Customer To</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Pembayaran Via | Trx. From</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp

                                @foreach($list_sudah_bayar as $s)
                                <tr>
                                    <td class="text-left">{{ $s->tanggal_jatuh_tempo }}</td>
                                    <td class="text-left">{{ $s->grup_pembayaran }}</td>
                                    <td class="text-left">{{ $s->customer_to }}</td>
                                    <td class="text-left">{{ $s->supplier }}</td>
                                    <td class="text-left">{{ $s->total_amount }}</td>
                                    <td class="text-center">{{ $s->flag_pembayaran_via }} | {{ $p->trx_from }}</td>
                                    <td class="text-left">
                                        <a class="btn btn-warning btn-sm" href=""><i class="fas fa-print"></i></a>
                                        <a class="btn btn-primary btn-sm" href=""><i class="fas fa-info"></i></a>
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