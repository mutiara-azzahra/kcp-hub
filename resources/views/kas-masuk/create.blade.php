@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-5">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4><b>Tambah Bukti Terima Pembayaran</b></h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('kas-masuk.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
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
                                    <strong>Tanggal Rincian Tagihan</strong>
                                    <input type="date" name="tanggal_rincian_tagihan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Toko</strong>
                                    <select name="kd_outlet" class="form-control" >
                                        <option value="">---Pilih Toko--</option>
                                        @foreach($master_outlet as $a)
                                            <option value="{{ $a->kd_outlet }}">{{ $a->kd_outlet }} | {{ $a->nm_outlet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Pembayaran Via</strong>
                                    <select name="pembayaran_via" class="form-control" >
                                        <option value="">---Pilih Pembayaran--</option>
                                        <option value="CASH">CASH</option>
                                        <option value="TRANSFER">TRANSFER</option>
                                        <option value="BG">BG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Nominal</strong>
                                    <input type="number" name="nominal" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>No. BG</strong>
                                    <input type="text" name="no_bg" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Tanggal Jatuh Tempo BG</strong>
                                    <input type="date" name="jatuh_tempo_bg" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Bank</strong>
                                    <input type="text" name="bank" class="form-control" placeholder="">
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