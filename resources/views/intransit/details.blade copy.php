@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details Intransit</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('intransit.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                            <table class="table table-hover bg-light table-bordered table-striped">
                                <thead>
                                    <tr style="background-color: #6082B6; color:white">
                                        <th class="text-center">No. SP AOP</th>
                                        <th class="text-center">Tgl. Packingsheet</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $intransit_header->no_surat_pesanan }}</td>
                                        <td class="text-center">{{ $intransit_header->tanggal_packingsheet }}</td>
                                        
                                        @if($intransit_header->status == 'I' )
                                        <td class="text-center">Intransit</td>
                                        @elseif($intransit_header->status == 'T' )
                                        <td class="text-center">Diterima</td>
                                        @endif
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                            <div class="col-lg-12 p-3">

                                <form action="{{ route('intransit.store_details')}}" method="POST">
                                @csrf

                                <table class="table table-hover table-sm bg-light table-bordered table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">No. Packingsheet</th>
                                            <th class="text-center">No. Doos</th>
                                            <th class="text-center">Part No.</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Tambah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[0][no_surat_pesanan]" value="{{ $intransit_header->no_surat_pesanan }}">
                                                            <input type="text" name="inputs[0][no_packingsheet]" class="form-control" placeholder="No. Packingsheet">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="text" name="inputs[0][no_doos]" class="form-control" placeholder="No. Doos">
                                                        </div>
                                                    </td>
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
                                                            <input type="number" name="inputs[0][qty]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <!-- <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="number" name="inputs[0][harga_pcs]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td> -->
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
                                                            <input type="hidden" name="inputs[${i}][no_surat_pesanan]" value="{{ $intransit_header->no_surat_pesanan }}">
                                                            <input type="text" name="inputs[${i}][no_packingsheet]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="text" name="inputs[${i}][no_doos]" class="form-control" placeholder="0">
                                                        </div>
                                                    </td>
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
                                                            <input type="number" name="inputs[${i}][qty]" class="form-control" placeholder="0">
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

    <script>
        function closeAlertAfterTime(alertId, milliseconds) {
            setTimeout(function () {
                var alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.style.display = 'none'; 
                }
            }, milliseconds);
        }
        closeAlertAfterTime('myAlert', 2500);
    </script>


@endsection