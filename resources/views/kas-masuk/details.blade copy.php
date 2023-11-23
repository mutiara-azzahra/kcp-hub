@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Details</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kas-masuk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('warning'))
        <div class="alert alert-success" id="myAlert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card" style="padding: 10px;">
        <div class="card-body">
            <div class="col-lg-8 p-1">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-left">Tgl. Transaksi</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_masuk->tanggal_rincian_tagihan }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">No. Kas Masuk</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_masuk->no_kas_masuk }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Terima Dari</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_masuk->terima_dari }}</b></td>
                    </tr>
                    <tr>
                        <th class="text-left">Keterangan</th>
                        <td>:</td>
                        <td class="text-left"><b>{{ $kas_masuk->keterangan }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12 p-1" id="main" data-loading="true">
        <form action="{{ route('surat-pesanan.store_details')}}" method="POST">
            @csrf
            <div class="table-container">
                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                    <thead>
                        <tr style="background-color: #6082B6; color:white">
                            <th class="text-center">Pekiraan</th>
                            <th class="text-center">Akuntansi To</th>
                            <th class="text-center">Total</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="input-fields">
                        <tr>
                            <td class="text-center">
                                <div class="form-group col-12">
                                    <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                                        <option value="">-- Pilih --</option>
                                        @foreach($perkiraan as $k)
                                            <option value="{{ $k->perkiraan }}"> {{ $k->sub_perkiraan }} | {{ $k->perkiraan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="akuntansi_to" class="form-control my-select" >
                                            <option value="">--Pilih--</option>
                                            <option value="D">Debet</option>
                                            <option value="K">Kredit</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="form-group col-12">
                                    <input type="text" name="het" for="het" id="het-default" class="form-control">
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
            </div>
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
    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(`<tr>
                <td class="text-center">
                    <div class="form-group col-12">
                        <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                            <option value="">-- Pilih --</option>
                            @foreach($perkiraan as $k)
                                <option value="{{ $k->perkiraan }}"> {{ $k->sub_perkiraan }} | {{ $k->perkiraan }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Pilih Bank</strong>
                        <select name="akuntansi_to" class="form-control my-select" >
                            <option value="">--Pilih--</option>
                            <option value="D">Debet</option>
                            <option value="K">Kredit</option>
                        </select>
                    </div>
                </div>
                <td class="text-center">
                    <div class="form-group col-12">
                        <input type="text" name="het" for="het" id="het-default" class="form-control">
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
        });

    </script>    

@endsection