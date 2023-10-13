@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Buat Pembelian Non AOP</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('invoice.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <div class="col-lg-6 p-1">
                            <table class="table table-hover bg-light table-striped">
                                <tr>
                                    <th class="text-left">No. Surat Pesanan / SP</th>
                                    <td>:</td>
                                    <td class="text-left"></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Kode / Nama Toko</th>
                                    <td>:</td>
                                    <td class="text-left"></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Plafond Toko</th>
                                    <td>:</td>
                                    <td class="text-left"></td>
                                </tr>
                                <tr>
                                    <th class="text-left">Piutang Terakhir</th>
                                    <td>:</td>
                                    <td class="text-left">
                                        <a class="btn btn-success btn-sm" href=""><i class="fas fa-eye"></i> Piutang Terakhir</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">

                                <form action="{{ route('pembelian-non-aop.store_details')}}" method="POST">
                                @csrf

                                <table class="table table-hover table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Part No | Nama Part</th>
                                            <th class="text-center">Stok</th>
                                            <th class="text-center">Qty</th>
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
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[0][nosp]" value="">
                                                            <input type="number" name="inputs[0][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[0][disc]" class="form-control" placeholder="0">
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
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[${i}][nosp]" value="">
                                                            <input type="number" name="inputs[${i}][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[${i}][disc]" class="form-control" placeholder="0">
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