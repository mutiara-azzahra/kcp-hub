@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Details Stok Gudang</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('stok-gudang.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                                        <th class="text-center">Vendor</th>
                                        <th class="text-center">Supplier</th>
                                        <th class="text-center">Tanggal Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $header->invoice_non }}</td>
                                        <td class="text-center">{{ $header->customer_to }}</td>
                                        <td class="text-center">{{ $header->supplier }}</td>
                                        <td class="text-center">{{ $header->tanggal_nota }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">

                                <form action="{{ route('stok-gudang.store_add_details')}}" method="POST">
                                @csrf

                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Kode Rak</th>
                                            <th class="text-center">Tambah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <select name="inputs[0][part_no]" class="form-control mr-2 my-select">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($master_part as $k)
                                                                    <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[0][invoice_non]" value="{{ $header->invoice_non }}">
                                                            <input type="number" name="inputs[0][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <select name="inputs[0][id_rak]" class="form-control mr-2 my-select">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($rak as $k)
                                                                    <option value="{{ $k->id }}"> {{ $k->kode_rak_lokasi }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <a type="button" class="btn btn-primary m-1" id="add"><i class="fas fa-plus"></i></a>                                                                                  
                                                        </div>
                                                    </td>
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
                        <select name="inputs[${i}][part_no]" class="form-control mr-2 my-select-1">
                            <option value="">-- Pilih --</option>
                            @foreach($master_part as $k)
                                <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="hidden" name="inputs[${i}][invoice_non]" value="{{ $header->invoice_non }}">
                        <input type="number" name="inputs[${i}][qty]" class="form-control" placeholder="0">
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <select name="inputs[${i}][id_rak]" class="form-control mr-2 my-select-1">
                            <option value="">-- Pilih --</option>
                            @foreach($rak as $k)
                                <option value="{{ $k->id }}"> {{ $k->kode_rak_lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-danger remove-table-row"><i class="fas fa-minus"></i></button>
                    </div>
                </td>
            </tr>
            `);
            $('.my-select-1').select2({
                width: '100%'
            });
        });

    $(document).on('click','.remove-table-row', function(){
        $(this).parents('tr').remove();
    })

    </script>

@endsection
