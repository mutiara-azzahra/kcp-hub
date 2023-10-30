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

                                <form action="{{ route('pembelian-non-aop.store_details')}}" method="POST">
                                @csrf

                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No | Nama</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">HET</th>
                                            <th class="text-center">Disc (%)</th>
                                            <th class="text-center">Tambah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <select name="inputs[0][part_no]" class="form-control mr-2">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($master_part as $k)
                                                                    <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[0][invoice_non]" value="{{ $pembelian->invoice_non }}">
                                                            <input type="number" name="inputs[0][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[0][harga]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[0][diskon_nominal]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <!-- <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                                        </div>
                                                    </td> -->
                                                </tr>
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
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(`<tr>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <select name="inputs[${i}][part_no]" class="form-control mr-2">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($master_part as $k)
                                                                    <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[${i}][invoice_non]" value="{{ $pembelian->invoice_non }}">
                                                            <input type="number" name="inputs[${i}][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[${i}][harga]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[${i}][diskon_nominal]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <button type="submit" class="btn btn-danger remove-table-row"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
            `);
        });

    $(document).on('click','.remove-table-row', function(){
        $(this).parents('tr').remove();
    })

    </script>

@endsection
