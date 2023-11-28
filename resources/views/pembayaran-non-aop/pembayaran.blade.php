@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>Group Pembayaran Non AOP</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('pembayaran-non-aop.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <form action="{{ route('pembayaran-non-aop.pembayaran-store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <label for="">Pembayaran Via</label>
                        <input type="hidden" name="invoice_non" value="{{ $invoice_non }}">
                        <select name="flag_pembayaran_via" class="form-control mr-2">
                            <option value="">-- Pilih Pembayaran --</option>
                            <option value="CASH">CASH</option>
                            <option value="TRANSFER">TRANSFER</option>
                            <option value="BG">BG</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Trx. From</label>
                        <select name="trx_from" class="form-control my-select" >
                            <option value="">---Pilih Kas Keluar--</option>
                            @foreach($kas_keluar as $a)
                                <option value="{{ $a->no_keluar }}">{{ $a->no_keluar }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <div class="float-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                           
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <table class="table table-hover bg-light table-bordered table-striped" id="example2">
                <thead>
                    <tr style="background-color: #6082B6; color:white">
                        <th class="text-center">Invoice Non AOP</th>
                        <th class="text-center">Tgl. Nota</th>
                        <th class="text-center">Invoice</th>
                        <th class="text-center">Tgl. Jatuh Tempo</th>
                        <th class="text-center">Customer To</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Amount Nota</th>
                    </tr>
                </thead>
                <tbody class="input-fields">
                    @foreach($bayar as $b)
                        <tr>
                            <td class="text-left">{{ $b->invoice_non }}</td>
                            <td class="text-left">{{ $b->tanggal_nota }}</td>
                            <td class="text-left">{{ $b->txt_invoice }}</td>
                            <td class="text-left">{{ $b->tanggal_jatuh_tempo }}</td>
                            <td class="text-left">{{ $b->customer_to }}</td>
                            <td class="text-left">{{ $b->supplier }}</td>
                            <td class="text-left">{{ $b->tanggal_jatuh_tempo }}</td>
                            <td class="text-right">Rp. {{ number_format($b->details_pembelian->sum('total_amount'), 3, ',', '.') }}</td>
                            <td class="text-right">Rp. {{ number_format($b->details_nota->sum('amount_nota'), 3, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
</div>
@endsection

@section('script')

@endsection