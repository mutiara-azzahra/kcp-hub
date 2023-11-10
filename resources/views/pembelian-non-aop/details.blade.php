@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Pembelian Non AOP</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('pembelian-non-aop.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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

        <div class="card" style="padding: 10px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 p-3">
                        <table class="table table-hover table-bordered bg-light table-striped">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Nota</th>
                                    <th class="text-center">Customer To</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Tanggal Nota</th>
                                    <th class="text-center">Tanggal Jatuh Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $pembelian->invoice_non }}</td>
                                    <td class="text-center">{{ $pembelian->customer_to }}</td>
                                    <td class="text-center">{{ $pembelian->supplier }}</td>
                                    <td class="text-center">{{ $pembelian->tanggal_nota }}</td>
                                    <td class="text-center">{{ $pembelian->tanggal_jatuh_tempo }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 p-3">
                        <form action="{{ route('pembelian-non-aop.store_details', $pembelian->invoice_non )}}" method="POST">
                        @csrf
                        <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">HET</th>
                                    <th class="text-center" style="width: 150px;">Disc (%)</th>
                                    <th class="text-center">Nominal</th>
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
                                            <input type="hidden" name="invoice_non" value="{{ $pembelian->invoice_non }}">
                                            <input type="text" name="part_no[]" class="form-control" value="{{ $t->part_no }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-12">
                                            <input type="text" name="qty[]" id="qty-{{ $i }}" class="form-control" value="{{ $t->qty }}" data-qty="{{ $t->qty }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-12">
                                            <input type="text" name="harga[]" id="harga-{{ $i }}" class="form-control" value="{{ $t->nama->het }}" data-harga="{{ $t->nama->het }}" readonly>
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
            </div>
        </div>

</div>
@endsection

@section('script')
    <script>

    function updateNominal(i) {
        const qty       = $('#qty-' + i).data('qty');
        const harga     = $('#harga-' + i).data('harga');
        const disc      = Number($('#disc-' + i).val());
        const nominal   = (harga * qty) - (harga * qty * disc / 100);

        const formattedNominal = Number(nominal).toLocaleString('id-ID');

        $('#nominal-' + i).val(formattedNominal);

        console.log(harga);

    }

    </script>

@endsection
