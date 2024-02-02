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
                            <th class="text-left">Rak Asal</th>
                            <td>:</td>
                            <td class="text-left"><b>{{ $barang_rak->rak->kode_rak_lokasi }}</b></td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-12 p-1" id="main" data-loading="true">
                    <form action="{{ route('kode-rak-lokasi.store_mutasi')}}" method="POST">
                        @csrf
                        <table class="table table-hover table-sm bg-light table-striped table-bordered" id="table">
                            <thead>
                                <tr style="background-color: #6082B6; color:white">
                                    <th class="text-center">Part No</th>
                                    <th class="text-center">Qty Awal</th>
                                    <th class="text-center">Qty Mutasi</th>
                                    <th class="text-center">Rak Tujuan</th>
                                </tr>
                            </thead>
                            <tbody class="input-fields">
                                <tr>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="part_no" class="form-control" value="{{ $barang_rak->part_no }}" readonly>
                                            <input type="hidden" name="rak_asal" class="form-control" value="{{ $barang_rak->id_rak }}" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" value="{{ $barang_rak->stok }}" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <input type="text" name="qty_mutasi" class="form-control" placeholder="0">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-group col-12">
                                            <select name="rak_tujuan" class="form-control mr-2 my-select">
                                                <option value="">-- Pilih --</option>
                                                @foreach($all_rak as $k)
                                                    <option value="{{ $k->id }}"> {{ $k->kode_rak_lokasi }}</option>
                                                @endforeach
                                            </select>
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
