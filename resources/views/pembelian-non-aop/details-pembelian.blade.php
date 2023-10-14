@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Detail Pembelian Non AOP</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('pembelian-non-aop.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <div class="row">
                        <div class="col-lg-12 p-3">
                            <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                                <thead>
                                    <tr style="background-color: #6082B6; color:white">
                                        <th class="text-center">Nota</th>
                                        <th class="text-center">Customer To</th>
                                        <th class="text-center">Supplier</th>
                                        <th class="text-center">Tanggal Nota</th>
                                        <th class="text-center">Tanggal Jatuh Tempo</th>
                                        <th class="text-center">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($pembelian_header as $f)
                                            <td class="text-left">{{ $f->invoice_non }}</td>
                                            <td class="text-left">{{ $f->customer_to }}</td>
                                            <td class="text-left">{{ $f->supplier }}</td>
                                            <td class="text-left">{{ $f->tanggal_nota }}</td>
                                            <td class="text-left">{{ $f->tanggal_jatuh_tempo }}</td>
                                            <td class="text-left">Rp. {{ number_format($f->details_pembelian->sum('total_amount'), 0, ',', '.') }}</td>
                                            
                                        @endforeach

                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">

                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No | Nama</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">PPN (%)</th>
                                            <th class="text-center">Disc (%)</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                    </thead>
                                        <tbody class="input-fields">
                                            @foreach ($pembelian_header as $p)
                                                @foreach ($p->details_pembelian as $d)
                                                <tr>
                                                    <td class="text-left">{{ $d->part_no }}</td>
                                                    <td class="text-center">{{ $d->qty }}</td>
                                                    <td class="text-left">Rp. {{ number_format($d->harga, 0, ',', '.') }}</td>
                                                    <td class="text-left">Rp. {{ number_format($d->total_ppn, 0, ',', '.') }}</td>
                                                    <td class="text-left">Rp. {{ number_format($d->total_diskon_persen, 0, ',', '.') }}</td>
                                                    <td class="text-left">Rp. {{ number_format($d->total_amount, 0, ',', '.') }}</td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection