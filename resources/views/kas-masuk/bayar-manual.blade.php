@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Tambah Kas Masuk Manual</b></h4>
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
                
            @endif

        <div class="card" style="padding: 10px;">
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{ route('kas-masuk.store-bukti-bayar') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Transaksi</strong>
                                    <input type="date" name="tanggal_rincian_tagihan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>KCP</strong>
                                    <select name="kd_outlet" class="form-control" >
                                        <option value="">---Pilih Toko--</option>
                                        <option value="KS">Kalsel</option>
                                        <option value="KT">Kalteng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Pembayaran Via</strong>
                                    <select name="kd_outlet" class="form-control" >
                                        <option value="">---Pilih Pembayaran--</option>
                                        <option value="Cash">Kalsel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Terima Dari</strong>
                                    <input type="number" name="nominal" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Keterangan</strong>
                                    <input type="text" name="keterangan" class="form-control" placeholder="">
                                </div>
                            </div>
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

@endsection