@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Surat Pesanan / SP by Sales</b></h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('surat-pesanan.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-left">No. Surat Pesanan / SP</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $nosp }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Kode / Nama Toko</th>
                                    <td>:</td>
                                    <td class="text-left">{{ $details->kd_outlet }} / {{ $details->nm_outlet }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Plafond Toko</th>
                                    <td>:</td>
                                    {{-- <td class="text-left">Rp. {{ number_format($details->outlet->plafond->nominal_plafond, 0, ',', '.') }}</td> --}}
                                </tr>
                                <tr>
                                    <th class="text-left">Piutang Terakhir</th>
                                    <td>:</td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href=""><i class="fas fa-eye"></i> Piutang Terakhir</a>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        @if($check === null)

                        <div class="col-lg-12 p-1">

                            <form action="{{ route('surat-pesanan.store_details')}}" method="POST">
                                @csrf

                                <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No | Nama Part | HET</th>
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
                                                                    <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} | Rp. {{ number_format($k->het, 0, ',', '.') }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[0][nosp]" value="{{ $nosp }}">
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

                        @else

                            <div class="col-lg-12 p-1">
                                <table class="table table-hover table-bordered table-sm bg-light table-striped" id="table">
                                    <thead>
                                        <tr style="background-color: #6082B6; color:white">
                                            <th class="text-center">Part No</th>
                                            <th class="text-center">HET</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Nominal Diskon</th>
                                            <th class="text-center">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="input-fields">
                                        @foreach($details->details_sp as $d)
                                        <tr>
                                            <td class="text-left">{{ $d->part_no }}</td>

                                            {{-- number_format($xxx, 0, ',', '.') --}}
                                            <td class="text-left">Rp. {{ number_format($d->hrg_pcs, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $d->qty }}</td>
                                            <td class="text-left">Rp. {{ number_format($d->nominal_disc, 0, ',', '.') }}</td>
                                            <td class="text-left">Rp. {{ number_format($d->nominal_total, 0, ',', '.') }}</td>
                                        </tr>
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
                                                                    <option value="{{ $k->part_no }}"> {{ $k->part_no }} | {{ $k->part_nama }} | Rp. {{ number_format($k->het, 0, ',', '.') }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group col-12">
                                                            <input type="hidden" name="inputs[${i}][nosp]" value="{{ $nosp }}">
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