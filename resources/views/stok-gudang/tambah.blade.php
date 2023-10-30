@extends('welcome')
 
@section('content')
<div class="container" style="padding: 10px;">
    <div class="row mt-2">
        <div class="col-lg-12 pb-3">
             <div class="float-left">
                <h4>Tambah Stok Gudang</h4>
            </div>
            <div class="float-right">
                    <a class="btn btn-success" href="{{ route('stok-gudang.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="{{ route('stok-gudang.store-barang-masuk') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <strong>Nomor Nota</strong>
                                    <input type="text" name="invoice_non" class="form-control" placeholder="contoh: 12-234-77">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <strong>Tanggal Nota</strong>
                                    <input type="date" name="tanggal_nota" class="form-control">
                                </div>
                            </div>
                                <div class="form-group col-md-6 col-lg-12">
                                    <label for="">Vendor</label>
                                    <select name="customer_to" class="form-control mr-2">
                                        <option value="">-- Pilih Vendor --</option>
                                        <option value="ICHIDAI">ICHIDAI</option>
                                        <option value="BRIO">BRIO</option>
                                        <option value="LIQUID">LIQUID</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-lg-12">
                                    <label for="">Supplier</label>
                                    <select name="supplier" class="form-control mr-2">
                                        <option value="">-- Pilih Supplier --</option>
                                        <option value="SSI">SSI</option>
                                        <option value="KMC">KMC</option>
                                        <option value="ABADI_MAKMUR">ABADI MAKMUR</option>
                                    </select>
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