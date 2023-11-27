@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-2">
             <div class="float-left">
                <h4>Balancing Nota dan Pembayaran</h4>
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
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody class="input-fields">

                @php
                $i = 0;
                @endphp

                @foreach($intransit_details as $t)
                <tr>
                    <td>
                        <div class="form-group col-12">
                            <input type="hidden" name="invoice_non" value="{{ $header->invoice_non }}">
                            <input type="text" name="part_no[]" class="form-control" value="{{ $t->part_no }}" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group col-12">
                            <input type="number" name="qty[]" class="form-control" id="qty-{{ $i }}" value="{{ $t->qty }}" data-qty="{{ $t->qty }}" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group col-12">
                            <input type="number" name="harga[]" class="form-control" id="harga-{{ $i }}" value="{{ $t->nama->het }}" data-harga="{{ $t->nama->het }}" readonly>
                        </div>
                    </td>
                    <td>
                        <div class="form-group col-12">
                            <input type="text" name="disc[]" id="disc-{{ $i }}" class="form-control" placeholder="0" onkeyup="updateNominal('{{ $i }}')">
                        </div>
                    </td>
                    <td>
                        <div class="form-group col-12">
                            <input type="text" id="nominal-{{ $i }}" class="form-control" placeholder="0" readonly>
                        </div>
                    </td>
                </tr>

                @php
                $i++;
                @endphp

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

</div>
@endsection

@section('script')

@endsection