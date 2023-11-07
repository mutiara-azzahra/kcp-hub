@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Detail Pembelian Non AOP</h4>
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
                                            <td class="text-right">Rp. {{ number_format($f->details_pembelian->sum('total_amount'), 0, ',', '.') }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        @if($check->isEmpty())
                        <div class="col-lg-12 p-3">
                                <form action="{{ route('pembelian-non-aop.store_details', $header->invoice_non )}}" method="POST">
                                @csrf
                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">HET</th>
                                            <th class="text-center" style="width: 150px;">Disc (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">

                                    @foreach($intransit_details as $i)
                                    <tr>
                                        <td>
                                            <div class="form-group col-12">
                                                <input type="hidden" name="invoice_non" value="{{ $header->invoice_non }}">
                                                <input type="text" name="part_no[]" class="form-control" value="{{ $i->part_no }}" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group col-12">
                                                <input type="number" name="qty[]" class="form-control" value="{{ $i->qty }}" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group col-12">
                                                <input type="number" name="harga[]" class="form-control" value="{{ $i->nama->het }}" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group col-12">
                                                <input type="text" name="disc[]" class="form-control" placeholder="0">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>                           
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="col-lg-12 p-3">
                            <table class="table table-hover table-bordered table-sm bg-light table-striped" id="example2">
                                <thead>
                                    <tr style="background-color: #6082B6; color:white">
                                        <th class="text-center">Part No | Nama</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">HET</th>
                                        <th class="text-center">Disc (%)</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="input-fields">
                                    @foreach ($pembelian_header as $p)
                                        @foreach ($p->details_pembelian as $d)
                                        <tr>
                                            <td class="text-left">{{ $d->part_no }}</td>
                                            <td class="text-right">{{ number_format($d->qty, 0, ',', '.') }}</td>
                                            <td class="text-right">Rp. {{ number_format($d->harga, 0, ',', '.') }}</td>
                                            @if( $d->diskon_nominal != null)
                                            <td class="text-center">{{ $d->diskon_nominal }}</td>

                                            @else
                                            <td class="text-center">-</td>

                                            @endif
                                            <td class="text-right">Rp. {{ number_format($d->total_amount, 2, ',', '.') }}</td>
                                        </tr>
                                        @endforeach   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif
                    </div>
                </div>
        </div>

</div>
@endsection

@section('script')

@endsection