@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-3">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Mutasi Part</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('kode-rak-lokasi.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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

    <div class="card" >
        <div class="card-body">
            <div class="row">

                <div class="col-lg-8 p-1">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-left">Part No</th>
                            <td>:</td>
                            <td class="text-left"><b></b></td>
                        </tr>
                        <tr>
                            <th class="text-left">Kode Rak</th>
                            <td>:</td>
                            <td class="text-left"><b></b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 p-1" id="main" data-loading="true">
                    <form action="{{ route('surat-pesanan.store_details')}}" method="POST">
                        @csrf
                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Keterangan Mutasi</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Tambah</th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="inputs[0][part_no]" class="form-control mr-2 my-select" id="package-default" onchange="updateData(`default`)">
                                                <option value="">-- Pilih --</option>
                                                @foreach($master_part as $k)
                                                    <option value="{{ $k->part_no }}" data-het="{{ $k->het }}"> {{ $k->part_no }} | {{ $k->part_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="het" for="het" id="het-default" class="form-control" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="hidden" name="inputs[0][nosp]" value="{{ $nosp }}">
                                            <input type="text" id="qty-default" name="inputs[0][qty]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" id="disc-default" name="inputs[0][disc]" class="form-control" placeholder="0" onkeyup="updateNominal(`default`)">
                                        </div>
                                    </td>
                                    <td class="text-center" id="nominal">
                                        <div class="form-group col-12">
                                            <input type="text" id="nominal-default" name="nominal" for="nominal" class="form-control" readonly>
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
</div>
@endsection

@section('script') 

@endsection
